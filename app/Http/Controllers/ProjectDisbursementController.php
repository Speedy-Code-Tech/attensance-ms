<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectDisbursementController extends Controller
{
    
    function index(){
        return view('link-pages.data-entries.project-disburse.index');
    }
}
