<?php

namespace App\Http\Controllers;

use App\Models\CashDisbursement;
use App\Models\Member;
use Illuminate\Http\Request;

class CashDisbursementController extends Controller
{
    function index(){
        $member = CashDisbursement::with('member')->get();
     
        return view('link-pages.data-entries.cash-disburse.index',compact('member'));
    }
    function create(){
        $member = new Member();
             return view('link-pages.data-entries.cash-disburse.create',['member'=>$member->all()]);
    }

    function store(Request $req){
        $req->validate([
            'expense'=>'required',
            'amount'=>'required|integer',
            'check'=>'required|integer',
            'fund_used'=>'required',
            'type'=>'required',
            'name'=>'required',
        ]);
        $date =  date('Y-m-d');
        $cashDisburse = new CashDisbursement();
        $member = Member::where('rotary_id', $req->input('name'))->first();


        $cashDisburse->date = $date;
        $cashDisburse->type = $req->input('type');
        $cashDisburse->payee = $member->last_name .','.$member->first_name .$member->middle_name;
        $cashDisburse->description = $req->input('description');
        $cashDisburse->fund_used = $req->input('fund_used');
        $cashDisburse->check_no = $req->input('check');
        $cashDisburse->amount = $req->input('amount');
        $cashDisburse->expense_type = $req->input('expense');
        $cashDisburse->remarks = $req->input('remarks');
        $cashDisburse->save();

        return redirect()->route('cashdis.index');
    }

    function destroy($id){
        $reciepts = CashDisbursement::find($id);
        $reciepts->delete();
        return redirect()->route('cashdis.index');
    }

    function edit($id){
        $member = CashDisbursement::where('id',$id)->first();
        return view('link-pages.data-entries.cash-disburse.edit',['member'=>$member,'people'=>Member::all()]);
    }

    function update($id,Request $req){
        $req->validate([
            'expense'=>'required',
            'amount'=>'required|integer',
            'check'=>'required|integer',
            'fund_used'=>'required',
            'type'=>'required',
            'name'=>'required',
        ]);
        $date =  date('Y-m-d');
        $cashDisburse = CashDisbursement::find($id);
        $member = Member::where('rotary_id', $req->input('name'))->first();


        $cashDisburse->date = $date;
        $cashDisburse->type = $req->input('type');
        $cashDisburse->payee = $member->last_name .','.$member->first_name .$member->middle_name;
        $cashDisburse->description = $req->input('description');
        $cashDisburse->fund_used = $req->input('fund_used');
        $cashDisburse->check_no = $req->input('check');
        $cashDisburse->amount = $req->input('amount');
        $cashDisburse->expense_type = $req->input('expense');
        $cashDisburse->remarks = $req->input('remarks');
        $cashDisburse->save();

        return redirect()->route('cashdis.index');
    }
}
