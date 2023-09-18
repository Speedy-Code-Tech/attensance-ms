<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

use App\Models\Schedule;
use App\Models\Attendance;

class QRScannerController extends Controller
{
    public function index() {
        $totalSchedules = Schedule::count();
        $totalAttendances = Attendance::count();

        // Get today's schedule
        $today = Carbon::today();
        $todaySchedule = Schedule::where('date', $today)->first();

        // Get attendance data for today's schedule
        $todayAttendance = null;
        if ($todaySchedule) {
            $todayAttendance = Attendance::where('schedule_id', $todaySchedule->id)->get();
        }

        return view('phone_attendance', compact('todayAttendance'));        
    }
}