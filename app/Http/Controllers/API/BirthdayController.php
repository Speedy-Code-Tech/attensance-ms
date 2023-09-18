<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use Carbon\Carbon;

class BirthdayController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::today()->year;
    
        $birthdays = Member::selectRaw('MONTH(birthday) as month, DAY(birthday) as day, GROUP_CONCAT(CONCAT(first_name, " ", last_name)) as members')
            ->whereNotNull('birthday')
            ->groupBy('month', 'day')
            ->orderByRaw('MONTH(birthday), DAY(birthday)')
            ->get();
    
        $processedBirthdays = $birthdays->map(function ($item) use ($currentYear) {
            $month = $item->month;
            $day = $item->day;
        
            $fullDate = Carbon::create($currentYear, $month, $day)->toDateString();
            $members = explode(',', $item->members);
        
            $processedMembers = [];
        
            foreach ($members as $memberName) {
                $member = Member::whereRaw("CONCAT(first_name, ' ', last_name) = ?", [$memberName])->first();
        
                if ($member) {
                    if ($member->profile_picture) {
                        $profilePictureUrl = asset('storage/' . $member->profile_picture);
                    } else {
                        $profilePictureUrl = null;
                    }
                    $processedMembers[] = [
                        'name' => $memberName,
                        'profile_picture' => $profilePictureUrl,
                    ];
                }
            }
        
            return [
                'date' => $fullDate,
                'month' => $month,
                'members' => $processedMembers,
            ];
        });
    
        // Group the processed data by month
        $groupedBirthdays = $processedBirthdays->groupBy('month');
    
        return response()->json($groupedBirthdays);
    }
}