<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Services\PushNotificationService;

use Carbon\Carbon;

use App\Models\Schedule as ScheduleModel;
use App\Models\User;
use App\Models\Attendance;

use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            // Get the current date
            $today = Carbon::today();
    
            // Get schedule for today
            $sched = ScheduleModel::whereDate('date', $today)->get();
    
            if ($sched) {
                // Get all users with a valid expoToken
                $usersWithExpoToken = User::whereNotNull('expoToken')->distinct('expoToken')->get();

                $userIds = $usersWithExpoToken->pluck('id')->toArray();
                $expoTokens = $usersWithExpoToken->pluck('expoToken')->toArray();
                $titles = array_fill(0, count($expoTokens), 'Reminder: Upcoming Rotary Schedule');
                $bodies = array_fill(0, count($expoTokens), 'You have a schedule today at the rotary. Don\'t forget to attend!');
    
                PushNotificationService::sendPushNotifications($userIds, $expoTokens, $titles, $bodies);
                
                Log::info('Notifications sent.');
            }
        })->dailyAt('09:00');

        // Send absent reminders via push notifications at 3 PM
        $schedule->call(function () {
            // Get the current date
            $today = Carbon::today();

            // Get schedule for today
            $sched = ScheduleModel::whereDate('date', $today)->get();

            if ($sched) {
                // Get the past 3 schedules (including today)
                $pastSchedules = ScheduleModel::whereDate('date', '<', $today)
                    ->orderBy('date', 'desc')
                    ->limit(5)
                    ->get();
    
                // Get all users
                $allUsers = User::all();
    
                foreach ($allUsers as $user) {
                    // Count the number of consecutive absent schedules
                    $consecutiveAbsentCount = 0;
                    foreach ($pastSchedules as $pastSchedule) {
                        $attendance = Attendance::where('member_id', $user->member->id)
                            ->where('schedule_id', $pastSchedule->id)
                            ->first();
    
                        if (!$attendance) {
                            // The user is absent for this schedule
                            $consecutiveAbsentCount++;
                        } else {
                            // The user attended this schedule, so reset the count
                            $consecutiveAbsentCount = 0;
                        }
    
                        if ($consecutiveAbsentCount >= 3) {
                            if ($user->expoToken) {
                                // Send push notification for absent reminder
                                PushNotificationService::sendPushNotification(
                                    $user->id,
                                    $user->expoToken,
                                    'Reminder: Consecutive Absences',
                                    'You have been absent for '.$consecutiveAbsentCount.' consecutive schedules. Please attend the next schedule.'
                                );
                            }
                            break; // No need to continue checking
                        }
                    }
                }
    
                Log::info('Push notifications sent for absent reminders.');
            }
        })->dailyAt('15:00');

        // Run the AdjustAttendance command daily
        $schedule->command('attendance:adjust')->daily();

        // Run the Send Birthday Notification command daily
        $schedule->command('notifications:birthday')->dailyAt('06:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}