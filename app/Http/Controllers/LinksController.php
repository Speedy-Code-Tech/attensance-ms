<?php

namespace App\Http\Controllers;

use App\Models\CashReceipt;
use App\Models\Member;
use Illuminate\Http\Request;


class LinksController extends Controller
{
    function index(){
        $reciepts = new CashReceipt();
        
        $data = $reciepts::with(['user'])->get();
        return view('link-pages.data-entries.cash-receipt.index',['receipts'=>$data,'failed'=>'']);
    }

    function cashdelete($id){
        $reciepts = CashReceipt::find($id);
        $reciepts->delete();
        return redirect()->route('data.index');
    }

    function cashcreate(){
        return view('link-pages.data-entries.cash-receipt.create',['failed'=>'']);
    }

    function cashstore(Request $req){
        $req->validate([
            'rotaryid'=>'required|integer',
            'status'=>'required | string',
            'type'=>'required |string',
            'payment'=>'required | string',
        ]);
       
        $member = new Member();

        if($member->where('rotary_id',$req->input('rotaryid'))->first()){
            $id = $member->where('rotary_id',$req->input('rotaryid'))->first();
    
            $cashreceipt = new CashReceipt();
            $cashreceipt->rotary_id = $id->id;
            $cashreceipt->status = $req->input('status');
            $cashreceipt->type = $req->input('type');
            $cashreceipt->latest_rotatry = $req->input('latestrotary');
            $cashreceipt->payment = $req->input('payment');
            $cashreceipt->save();
            return redirect()->route('data.index')->with('success', 'Cash Receipt created successfully!');
        }else{
            // return redirect()->route('cash.create')->with('failed',`<div class="alert alert-danger" id="err" style="position: absolute; right: 30px;">No Rotary Id Mathes in the Database</div>`);
        }


    }

   function cashedit($id){
    $data =  CashReceipt::where('id',$id);
    return view('link-pages.data-entries.cash-receipt.edit',['data'=>$data->first()]);
   }

   function cashsaveedit($id, Request $req){
    $req->validate([
        'rotaryid'=>'required|integer',
        'status'=>'required | string',
        'type'=>'required |string',
        'payment'=>'required | string',
    ]);
    $member = new Member();
    $ids = $member->where('rotary_id',$req->input('rotaryid'))->first();
    $data =  CashReceipt::where('id',$id)->first();

    $data->rotary_id = $ids->id;
    $data->status = $req->input('status');
    $data->type = $req->input('type');
    $data->latest_rotatry = $req->input('latestrotary');
    $data->payment = $req->input('payment');
    $data->save();
    return redirect()->route('data.index')->with('success', 'Cash Receipt created successfully!');
   }
}
