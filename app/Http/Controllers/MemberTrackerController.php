<?php

namespace App\Http\Controllers;

use App\Models\CashReceipt;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberTrackerController extends Controller
{
    function index(){
        $member = Member::with('user','payment')->get();
   
        return view('link-pages.monitoring.members-tracker.index',['mem'=>$member]);
    }
}
