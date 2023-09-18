<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashDisbursement extends Model
{
    use HasFactory;

    protected $table = 'cash_disbursement';

    public function member(){
    
        return $this->belongsTo(Member::class,'rotary_id','id');
    } 
}
