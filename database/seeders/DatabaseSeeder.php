<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Member;
use App\Models\Schedule;
use App\Models\Attendance;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'username' => 'admin',
            'email' => 'admin@rotary-ams.site',
            'password' => bcrypt('rotary2023'),
            'role' => 'admin',
        ]);

        // // Create member users and associated members
        // $membersData = [
        //     [
        //         'username' => 'ronnelrobles',
        //         'email' => 'ronnel@es.com',
        //         'password' => bcrypt('rotary2023'),
        //         'role' => 'member',
        //         'first_name' => 'Ronnel',
        //         'last_name' => 'Robles',
        //         // Add other member data as needed
        //     ],
        //     [
        //         'username' => 'honeyleendelmonte',
        //         'email' => 'honey@rotary.com',
        //         'password' => bcrypt('rotary2023'),
        //         'role' => 'member',
        //         'first_name' => 'Honeyleen',
        //         'last_name' => 'Del Monte',
        //         // Add other member data as needed
        //     ],
        // ];

        // foreach ($membersData as $memberData) {
        //     $user = User::create([
        //         'username' => $memberData['username'],
        //         'email' => $memberData['email'],
        //         'password' => $memberData['password'],
        //     ]);

        //     $member = $user->member()->create([
        //         'first_name' => $memberData['first_name'],
        //         'last_name' => $memberData['last_name'],
        //         'rotary_id' => 'invalid_' . Str::random(8)
        //         // Add other member data as needed
        //     ]);

        //     $user->member_id = $member->id;
        //     $user->save();
        // }

        // // Create 10 schedules (consecutive Fridays based on the current date)
        // $startDate = Carbon::now()->startOfWeek()->next(Carbon::FRIDAY);
        // for ($i = 0; $i < 10; $i++) {
        //     Schedule::create([
        //         'date' => $startDate->copy()->addWeeks($i)->toDateString(),
        //     ]);
        // }

        // // Create random attendances for the member users
        // $users = User::where('role', 'member')->get();
        // $schedules = Schedule::all();
        // foreach ($users as $user) {
        //     foreach ($schedules as $schedule) {
        //         if (rand(0, 1)) {
        //             Attendance::create([
        //                 'member_id' => $user->member->id,
        //                 'attended_at' => $schedule->date,
        //                 'schedule_id' => $schedule->id,
        //                 'makeup_date' => null,
        //                 'is_makeup' => 0,
        //                 'user_id' => User::inRandomOrder()->where('role', 'admin')->first()->id,
        //                 'method' => rand(0, 1) ? 'QR code' : 'Manual',
        //             ]);
        //         }
        //     }
        // }
    }
}