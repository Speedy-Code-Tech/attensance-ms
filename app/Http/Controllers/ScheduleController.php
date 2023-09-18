<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Member;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Services\PushNotificationService;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
    
        $query = Schedule::query();
    
        if ($start_date) {
            $query->where('date', '>=', $start_date);
        }
    
        if ($end_date) {
            $query->where('date', '<=', $end_date);
        }
    
        $schedules = $query->get();

        $members = Member::all();
    
        return view('schedules.index', compact('schedules', 'members'));
    }

    public function create()
    {
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string',
            'date' => 'required|date|unique:schedules',
            'is_makeup' => 'boolean',
            // Add validation for any additional fields related to the schedule here
        ]);

        $schedule = Schedule::create([
            'name' => $data['name'],
            'date' => $data['date'],
            'is_makeup' => $data['is_makeup'] ?? 0
        ]);

        // // Fetch all members
        // $allMembers = Member::all();

        // // Filter members based on the computed property isRuleOfEightyFive
        // $exemptedMembers = $allMembers->filter(function ($member) {
        //     return $member->isRuleOfEightyFive;
        // });
        
        // foreach ($exemptedMembers as $exemptedMember) {
        //     Attendance::create([
        //         'member_id' => $exemptedMember->id,
        //         'schedule_id' => $schedule->id,
        //         'attended_at' => Carbon::now(),
        //         'is_makeup' => false, // Mark it as a regular attendance
        //         'user_id' => auth()->user()->id, // Log the user who created the schedule
        //         'method' => 'Rule of 85', // You can change this value as needed
        //     ]);
        // }

        // Get all users with a valid expoToken
        $usersWithExpoToken = User::whereNotNull('expoToken')->distinct('expoToken')->get();

        $userIds = $usersWithExpoToken->pluck('id')->toArray();
        $expoTokens = $usersWithExpoToken->pluck('expoToken')->toArray();
        $titles = array_fill(0, count($expoTokens), 'New Rotary Schedule Created');
        $bodies = array_fill(0, count($expoTokens), $schedule->name . ' was scheduled for ' . $schedule->date . '. Make sure to mark it on your calendar!');

        PushNotificationService::sendPushNotifications($userIds, $expoTokens, $titles, $bodies);

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully!');
    }

    public function show(Schedule $schedule)
    {
        // Load the attendance logs for the specific schedule
        $attendanceLogs = $schedule->attendances()->with('member', 'user')->get();
    
        return view('schedules.show', compact('schedule', 'attendanceLogs'));
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'name' => 'string',
            'date' => 'required|date|unique:schedules,date,' . $schedule->id,
            'is_makeup' => 'boolean',
            // Add validation for any additional fields related to the schedule here
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully!');
    }

    public function destroy(Schedule $schedule)
    {
        // Delete the related attendances
        $schedule->attendances()->delete();
        
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully!');
    }

    public function attendanceSheet(Request $request)
    {
        $members = Member::all();
    
        // Get the unique years from the schedules table
        $years = Schedule::distinct()->get([DB::raw('YEAR(date) as year')])->pluck('year');
    
        // Get the default filter dates (start of the current year to end of the current year)
        $defaultStartDate = Carbon::now()->startOfYear();
        $defaultEndDate = Carbon::now()->endOfYear();
    
        // Get the selected start and end dates from the request (or use default values if not provided)
        $selectedStartDate = $request->input('start_date', $defaultStartDate->format('Y-m-d'));
        $selectedEndDate = $request->input('end_date', $defaultEndDate->format('Y-m-d'));
    
        // Get the schedules for the selected date range, ordered by date
        $schedules = Schedule::whereBetween('date', [$selectedStartDate, $selectedEndDate])->orderBy('date')->get();
    
        // Prepare the attendance data for display
        $attendanceData = [];
    
        // Separate makeup and non-makeup schedules
        $makeupSchedules = $schedules->where('is_makeup', true);
        $nonMakeupSchedules = $schedules->where('is_makeup', false);
    
        foreach ($members as $member) {
            // Initialize arrays for storing attendance data for each member
            $makeupAttendanceData = [];
            $nonMakeupAttendanceData = [];
    
            foreach ($makeupSchedules as $schedule) {
                $attendance = $member->attendances->where('schedule_id', $schedule->id)->first();
    
                if ($attendance) {
                    $makeupAttendanceData[$schedule->id] = 'Makeup';
                } else {
                    $makeupAttendanceData[$schedule->id] = 'Absent';
                }
            }
    
            foreach ($nonMakeupSchedules as $schedule) {
                $attendance = $member->attendances->where('schedule_id', $schedule->id)->first();
    
                if ($attendance) {
                    if ($attendance->is_makeup) {
                        $nonMakeupAttendanceData[$schedule->id] = 'Makeup';
                    } else {
                        $nonMakeupAttendanceData[$schedule->id] = 'Present';
                    }
                } else {
                    $nonMakeupAttendanceData[$schedule->id] = 'Absent';
                }
            }
    
            // Store the attendance data for the member
            $attendanceData[$member->id] = [
                'makeup' => $makeupAttendanceData,
                'non_makeup' => $nonMakeupAttendanceData,
            ];
        }
    
        return view('attendance_sheet', compact('members', 'makeupSchedules', 'nonMakeupSchedules', 'attendanceData', 'years', 'selectedStartDate', 'selectedEndDate'));
    }
    
}