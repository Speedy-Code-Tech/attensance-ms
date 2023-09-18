<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Member;
use App\Models\Schedule;

class ScheduleController extends Controller
{
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
    
        // Create and return the API response
        return response()->json([
            'members' => $members,
            'makeup_schedules' => $makeupSchedules,
            'non_makeup_schedules' => $nonMakeupSchedules,
            'attendance_data' => $attendanceData,
            'years' => $years,
            'selected_start_date' => $selectedStartDate,
            'selected_end_date' => $selectedEndDate,
        ]);
    }
}