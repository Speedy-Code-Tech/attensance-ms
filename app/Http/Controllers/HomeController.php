<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Member;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\User;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin() || $user->isStaff()) {
            $totalMembers = Member::count();
            $totalSchedules = Schedule::count();
            $totalAttendances = Attendance::count();

            // Get today's schedule
            $today = Carbon::today();
            $todaySchedule = Schedule::where('date', $today)->first();
    
            // Get attendance data for today's schedule
            $todayAttendance = 0;
            if ($todaySchedule) {
                $todayAttendance = Attendance::where('schedule_id', $todaySchedule->id)->count();
            }

            $todayAbsent = $totalMembers - $todayAttendance;

            $scheduleLabels = Schedule::pluck('date')->toArray();
            $scheduleData = [];
            
            foreach ($scheduleLabels as $date) {
                $schedule = Schedule::where('date', $date)->first();
                $attendedCount = DB::table('attendances')
                    ->where('schedule_id', $schedule->id)
                    ->count();
                $absentCount = $totalMembers - $attendedCount;
                
                $scheduleData['attended'][] = $attendedCount;
                $scheduleData['absent'][] = $absentCount;
            }

            return view('home', compact('totalMembers', 'totalSchedules', 'totalAttendances', 'todaySchedule', 'todayAttendance', 'todayAbsent', 'scheduleLabels', 'scheduleData'));
        } else {
            // Assuming the authenticated user is a regular member
            $userId = $user->id;
            $totalSchedules = Schedule::count();
            $totalAttendances = Attendance::where('member_id', $userId)->count();
            // Add more attendance-related data as per your requirement
            $daysAttended = $totalAttendances; // Calculate the number of days attended by the member
            $daysAbsent = Schedule::count() - $totalAttendances; // Calculate the number of days absent for the member

            return view('home', compact('totalAttendances', 'totalSchedules', 'daysAttended', 'daysAbsent'));
        }
    }

    
    public function attendanceChartData()
    {
        $scheduleLabels = Schedule::pluck('date')->toArray();
        $scheduleData = [];
        
        foreach ($scheduleLabels as $date) {
            $schedule = Schedule::where('date', $date)->first();
            $attendedCount = DB::table('attendances')
                ->where('schedule_id', $schedule->id)
                ->count();
            $absentCount = count($schedule->members) - $attendedCount;
            
            $scheduleData['attended'][] = $attendedCount;
            $scheduleData['absent'][] = $absentCount;
        }

        return response()->json(compact('scheduleLabels', 'scheduleData'));
    }

    public function settings() {
        // Check if there is a success message in the session
        $success = session('success');
        
        return view('admin.settings')->with('success', $success);
    }

    public function changePassword(Request $request, User $user) {
        $data = $request->validate([
            'newPassword' => 'required|string',
        ]);
        $user->password = bcrypt($data['newPassword']);
        $user->save();

        return view('admin.settings')->with('success', 'Admin password updated successfully!');
    }
}