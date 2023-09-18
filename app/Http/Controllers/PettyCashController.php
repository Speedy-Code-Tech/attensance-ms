<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PettyCashController extends Controller
{
    
    function index(){
        return view('link-pages.data-entries.petty-cash.index');
    }
}
