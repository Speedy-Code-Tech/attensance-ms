<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\User;

use Illuminate\Support\Facades\Log;

class AdjustAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:adjust';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adjust attendance records based on makeup policy and surplus attendances';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get all makeup schedule dates
        $makeupSchedules = Schedule::where('is_makeup', true)->pluck('date');

        foreach ($makeupSchedules as $makeupDateStr) {
            $makeupDate = Carbon::parse($makeupDateStr); // Convert the string to a Carbon instance

            // Calculate date ranges for 14 days prior and after the makeup schedule
            $startDate = $makeupDate->copy()->subDays(14);
            $endDate = $makeupDate->copy()->addDays(14);

            // Get attendances for members within the date range
            $attendancesInRange = Attendance::whereBetween('attended_at', [$startDate, $endDate])->get();

            // Group attendances by member ID
            $attendancesByMember = $attendancesInRange->groupBy('member_id');

            $firstAdminUser = User::where('role', 'admin')->first();

            foreach ($attendancesByMember as $memberId => $memberAttendances) {
                // Check if the makeup schedule was already credited for a schedule within the last 14 days
                $last14DaysSchedules = Schedule::whereBetween('date', [$makeupDate->copy()->subDays(14), $makeupDate])->get();
                $hasAbsentWithinLast14Days = $last14DaysSchedules->pluck('id')->diff($memberAttendances->pluck('schedule_id'))->count() > 0;

                // Check if the member has already used their makeup attendance
                $hasUsedMakeupAttendance = $memberAttendances->where('is_makeup', true)->count() > 1;

                if (!$hasUsedMakeupAttendance && !$hasAbsentWithinLast14Days) {
                    // Find schedules where member has no attendance within 14 days after makeup and before today
                    $schedulesWithoutAttendance = Schedule::whereBetween('date', [$makeupDate, $makeupDate->copy()->addDays(14)])
                        ->where('date', '<=', Carbon::today()) // Check if the schedule is before today
                        ->whereNotIn('id', $memberAttendances->pluck('schedule_id'))
                        ->get();

                    // Create makeup attendance for the member
                    foreach ($schedulesWithoutAttendance as $schedule) {
                        Attendance::create([
                            'member_id' => $memberId,
                            'schedule_id' => $schedule->id,
                            'attended_at' => $makeupDate,
                            'is_makeup' => true,
                            'method' => 'System',
                            'user_id' => $firstAdminUser->id
                        ]);
                    }
                }
            }
        }

        $this->info('Attendance adjustments completed.');
        Log::info('Attendance adjustments completed.');
    }
}