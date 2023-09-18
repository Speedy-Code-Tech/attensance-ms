<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

use Carbon\Carbon;

class AttendanceLogController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Use the provided start and end date to filter the records
        $query = Attendance::with('member', 'schedule', 'user');
    
        if ($startDate && $endDate) {
            $query->whereBetween('attended_at', [$startDate, $endDate]);
        }
    
        $attendanceLogs = $query->get();
    
        return view('attendance_logs.index', compact('attendanceLogs'));
    }

    public function create()
    {
        $members = Member::all();
        $schedules = Schedule::all();

        return view('attendance_logs.create', compact('members', 'schedules'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'attended_at' => 'required|date',
            'schedule_id' => 'required|exists:schedules,id',
            'notes' => 'nullable|string',
        ]);

        // You can get the logged-in user's ID from the authenticated user
        $data['user_id'] = auth()->user()->id;

        // Store the attendance log
        Attendance::create([
            'member_id' => $data['member_id'],
            'attended_at' => $data['attended_at'],
            'schedule_id' => $data['schedule_id'],
            'user_id' => $data['user_id'],
            'method' => 'Manual',
            'notes' => $request->input('notes') ?? null,
        ]);

        // Check if the schedule is a makeup schedule
        $schedule = Schedule::where('id', $data['schedule_id'])->first();
        $today = Carbon::today();

        // Get the current date and time
        $now = Carbon::now('Asia/Manila');

        if ($schedule && $schedule->is_makeup) {
            // Find the nearest absent schedule for the member
            $nearestAbsentSchedule = Schedule::where('date', '<', $schedule->date)
                ->where('date', '>=', $now->subDays(15)) // 14 days prior to the current date
                ->whereDoesntHave('attendances', function ($query) use ($data) {
                    $query->where('member_id', $data['member_id']);
                })
                ->orderBy('date', 'desc')
                ->first();

            if ($nearestAbsentSchedule) {
                // Log attendance for the nearest absent schedule as well
                Attendance::create([
                    'member_id' => $data['member_id'],
                    'attended_at' => $nearestAbsentSchedule->date,
                    'schedule_id' => $nearestAbsentSchedule->id,
                    'makeup_date' => $today,
                    'user_id' => $data['user_id'],
                    'method' => 'Manual',
                    'is_makeup' => true,
                ]);
            }
        }

        return redirect()->route('attendance-logs.index')->with('success', 'Attendance log created successfully!');
    }

    public function edit(Attendance $attendance)
    {
        $members = Member::all();
        $schedules = Schedule::all();
        return view('attendance_logs.edit', compact('attendance', 'members', 'schedules'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'schedule_id' => 'required|exists:schedules,id',
            'attended_at' => 'boolean',
            'notes' => 'nullable|string',
            // Add validation for any additional fields related to the attendance here
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendance-logs.index')->with('success', 'Attendance updated successfully!');
    }

    public function destroy(Attendance $attendanceLog)
    {
        $attendanceLog->delete();

        return redirect()->route('attendance-logs.index')->with('success', 'Attendance log deleted successfully!');
    }

    public function attendance() {
        $totalMembers = Member::count();

        $today = Carbon::today();
        $todaySchedule = Schedule::where('date', $today)->first();
    
        // Get attendance data for today's schedule
        $todayAttendance = 0;
        if ($todaySchedule) {
            $todayAttendance = Attendance::where('schedule_id', $todaySchedule->id)->count();
        }

        $todayAbsent = $totalMembers - $todayAttendance;

        $attendances = Attendance::with('member')->whereDate('attended_at', $today)->get();

        return view('attendance', compact('totalMembers', 'todaySchedule', 'todayAttendance', 'todayAbsent', 'attendances'));
    }

    public function getRecentAttendances()
    {
        $today = Carbon::today();
        $todaySchedule = Schedule::where('date', $today)->first();
    
        if ($todaySchedule) {
            $attendances = Attendance::with('member')->where('schedule_id', $todaySchedule->id)->latest()->take(10)->get();
            $totalAttendances = $todaySchedule->attendances->count();
            $totalMembers = Member::count();
            $totalAbsents = $totalMembers - $totalAttendances;
            
            return response()->json([
                'attendances' => $attendances,
                'total_attendances' => $totalAttendances,
                'total_absents' => $totalAbsents,
                'total_members' => $totalMembers,
            ]);
        } else {
            return response()->json(['message' => 'No schedule for today'], 404);
        }
    } 

}