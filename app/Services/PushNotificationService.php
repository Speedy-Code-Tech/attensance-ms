<?php

namespace App\Services;

use GuzzleHttp\Client;

use App\Models\Notification;

class PushNotificationService
{
    public static function sendPushNotifications(array $userIds, array $expoTokens, array $titles, array $bodies)
    {
        $client = new Client();

        $messages = [];

        foreach ($expoTokens as $index => $token) {
            $messages[] = [
                'to' => $token,
                'title' => $titles[$index],
                'body' => $bodies[$index],
                'sound' => 'default',
                'vibrate' => true
            ];

                // Save the notification to the database
                Notification::create([
                    'user_id' => $userIds[$index],
                    'title' => $titles[$index],
                    'body' => $bodies[$index],
                    'created_at' => now(),
                ]);
        }

        try {
            $response = $client->post('https://exp.host/--/api/v2/push/send', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip, deflate',
                    'Content-Type' => 'application/json',
                ],
                'json' => $messages,
            ]);
    
            return $response->getBody();
        } catch (\Exception $e) {
            // Handle the exception here, you can log the error or take any appropriate action
            return 'Error sending push notifications: ' . $e->getMessage();
        }
    }

    public static function sendPushNotification($userId, $expoToken, $title, $body)
    {
        $client = new Client();

        $response = $client->post('https://exp.host/--/api/v2/push/send', [
            'headers' => [
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip, deflate',
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'to' => $expoToken,
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
                'vibrate' => true
            ],
        ]);

        // Save the notification to the database
        Notification::create([
            'user_id' => $userId,
            'title' => $title,
            'body' => $body,
            'created_at' => now(),
        ]);

        return $response->getBody();
    }
}