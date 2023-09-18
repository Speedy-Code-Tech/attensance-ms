<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function getAttendanceToday()
    {
        $today = Carbon::today(); 

        $attendances = Attendance::with('member')->whereDate('attended_at', $today)->get();

        return response()->json($attendances);
    }

    public function logAttendance(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
        ]);
    
        $member_id = $request->input('member_id');
        $member = Member::where('id', $member_id)->first();

        if (!$member || $member->trashed()) {
            return response()->json(['message' => 'Member not found or is deleted'], 404);
        }
    
        // Check if there is a schedule for today
        $today = Carbon::today();
        $schedule = Schedule::whereDate('date', $today)->first();
    
        if (!$schedule) {
            return response()->json(['message' => 'No schedule for today'], 404);
        }
    
        // Check if the member has already logged attendance for today's schedule
        $existingAttendance = Attendance::where('member_id', $member_id)
            ->where('schedule_id', $schedule->id)
            ->whereDate('attended_at', $today)
            ->first();
    
        if ($existingAttendance) {
            return response()->json(['message' => 'Attendance already logged for today'], 409);
        }

        // Get the current date and time
        $now = Carbon::now('Asia/Manila');
    
        // Get the authenticated user (admin or staff) who is logging the attendance
        $user = Auth::user();
    
        // Check if today's schedule is a makeup schedule
        if ($schedule->is_makeup) {
            // Log attendance for today's schedule
            $attendance = Attendance::create([
                'member_id' => $request->input('member_id'),
                'schedule_id' => $schedule->id,
                'attended_at' => $now,
                'is_makeup' => true,
                'user_id' => $user->id, // Store the user_id of the admin or staff who logged the attendance
                'method' => "QR Code",
            ]);
    
            // Find the nearest absent schedule for the member
            $nearestAbsentSchedule = Schedule::where('date', '<', $today)
                ->where('date', '>=', $now->subDays(15)) // 14 days prior to the current date
                ->whereDoesntHave('attendances', function ($query) use ($request) {
                    $query->where('member_id', $request->input('member_id'));
                })
                ->orderBy('date', 'desc')
                ->first();
    
            if ($nearestAbsentSchedule) {
                // Log attendance for the nearest absent schedule as well
                Attendance::create([
                    'member_id' => $request->input('member_id'),
                    'schedule_id' => $nearestAbsentSchedule->id,
                    'attended_at' => $nearestAbsentSchedule->date,
                    'makeup_date' => $now,
                    'is_makeup' => true,
                    'user_id' => $user->id, // Store the user_id of the admin or staff who logged the attendance
                    'method' => "QR Code",
                ]);
            }
    
            return response()->json(['message' => 'Attendance logged successfully', 'member' => $member, 'attendance' => $attendance]);
        } else {
            // Log attendance for today's schedule
            $attendance = Attendance::create([
                'member_id' => $request->input('member_id'),
                'schedule_id' => $schedule->id,
                'attended_at' => $now,
                'is_makeup' => false,
                'user_id' => $user->id, // Store the user_id of the admin or staff who logged the attendance
                'method' => "QR Code",
            ]);
    
            return response()->json(['message' => 'Attendance logged successfully', 'member' => $member, 'attendance' => $attendance]);
        }
    }
    
}