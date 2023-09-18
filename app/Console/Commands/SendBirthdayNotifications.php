<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Member;
use App\Services\PushNotificationService; // Make sure to import the service

class SendBirthdayNotifications extends Command
{
    protected $signature = 'notifications:birthday';
    protected $description = 'Send birthday notifications to members';

    public function handle()
    {
        $today = Carbon::today();

        // Find members whose birthday is today
        $birthdayMembers = Member::whereMonth('birthday', $today->month)
            ->whereDay('birthday', $today->day)
            ->get();

        $totalBirthdayMembers = $birthdayMembers->count();

        if ($totalBirthdayMembers > 0) {
            // Send birthday greetings to members with birthdays
            foreach ($birthdayMembers as $member) {
                PushNotificationService::sendPushNotification(
                    $member->id,
                    $member->expoToken,
                    'Happy Birthday!',
                    'Wishing you a fantastic birthday!'
                );
            }
        }

        // Send notifications to other members about birthdays
        if ($totalBirthdayMembers > 0) {
            $message = "{$totalBirthdayMembers} member(s) are celebrating their birthday today!";
            $allMembers = Member::all();
    
            $userIds = [];
            $expoTokens = [];
            $titles = [];
            $bodies = [];
            foreach ($allMembers as $member) {
                if (!$birthdayMembers->contains('id', $member->id)) {
                    $userIds[] = $member->id;
                    $expoTokens[] = $member->expoToken;
                    $titles[] = 'Member Birthday';
                    $bodies[] = $message;
                }
            }
            // Send all notifications in bulk
            PushNotificationService::sendPushNotifications($userIds, $expoTokens, $titles, $bodies);
        } 

        $this->info('Birthday notifications sent.');
    }
}