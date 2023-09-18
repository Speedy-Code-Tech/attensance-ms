<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashAdvanceController extends Controller
{
    function index(){
        return view('link-pages.data-entries.cash-advances.index');
    }
}
