<?php

namespace App\Http\Controllers;

use App\Models\CashReceipt;
use App\Models\Member;
use Illuminate\Http\Request;

class CashReceiptController extends Controller
{
    public function index(){
        $reciepts = new CashReceipt();
        
        $data = $reciepts::with(['user'])->get();
        return view('link-pages.data-entries.cash-receipt.index',['receipts'=>$data,'failed'=>'']);
    }

    function cashcreate(){
        $member = Member::all();
        return view('link-pages.data-entries.cash-receipt.create',['member'=>$member]);
    }

    public function destroy($id){
        $reciepts = CashReceipt::find($id);
        $reciepts->delete();
        return redirect()->route('cash.index');

    }

    function cashstore(Request $req){
        $req->validate([
            'rotaryid'=>'required|integer',
            'amount'=>'required|integer',
            'type_of_payment'=>'required',
            'mode_of_payment'=>'required',
        ]);

        $cashReceipt = new CashReceipt();
        $mem = Member::where('rotary_id',$req->input('rotaryid'))->first();
        $cashReceipt->rotary_id=$mem->id;
        $cashReceipt->amount=$req->input('amount');
        $cashReceipt->type_of_payment=$req->input('type_of_payment');
        $cashReceipt->mode_of_payment=$req->input('mode_of_payment');
        $date =  date('Y-m-d');
        $cashReceipt->date = $date;
        $cashReceipt->remarks= $req->input('remarks');
        $cashReceipt->save();

        return redirect()->route('cash.index'); 


        
    }


    public function cashedit($id){
        $cashReceipt = CashReceipt::with('user')->find($id);
        $member = Member::all();
      
        return view('link-pages.data-entries.cash-receipt.edit',['data'=>$cashReceipt,'member'=>$member]);
    }

    function cashsaveedit($id, Request $req){
        $req->validate([
            'rotaryid'=>'required|integer',
            'amount'=>'required|integer',
            'type_of_payment'=>'required',
            'mode_of_payment'=>'required',
        ]);

        $cashReceipt = CashReceipt::find($id);
        $mem = Member::where('rotary_id',$req->input('rotaryid'))->first();
        $cashReceipt->rotary_id=$mem->id;
        $cashReceipt->amount=$req->input('amount');
        $cashReceipt->type_of_payment=$req->input('type_of_payment');
        $cashReceipt->mode_of_payment=$req->input('mode_of_payment');
        $date =  date('Y-m-d');
        $cashReceipt->date = $date;
        $cashReceipt->remarks= $req->input('remarks');
        $cashReceipt->save();

        return redirect()->route('cash.index');
    }
}

