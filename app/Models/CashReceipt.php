<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashReceipt extends Model
{
    use HasFactory;

    protected $table = 'cash_receipt';
    protected $fillable = ['rotatry_id', 'status', 'type','payment'];
    public function user()
    {
        return $this->belongsTo(Member::class,'rotary_id','id');
    }
}
