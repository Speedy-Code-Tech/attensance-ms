<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Member;

class MemberController extends Controller
{
    public function getRuleOf85Members(Request $request)
    {
        $members = Member::all();
    
        $ruleOf85Members = $members->filter(function ($member) {
            return $member->isRuleOfEightyFive;
        })->map(function ($member) {
            return [
                'name' => $member->first_name . ' ' . $member->last_name,
                'profile_picture' => $member->profile_picture ? asset('storage/' . $member->profile_picture) : null,
                'birthday' => $member->birthday,
                'age' => $member->age,
                'member_at' => $member->member_at,
                'years_of_service' => $member->joined_age,
                'total_years' => $member->age + $member->joined_age
            ];
        });
    
        return response()->json($ruleOf85Members);
    }
}