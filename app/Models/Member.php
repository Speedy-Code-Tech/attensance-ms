<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['first_name', 'middle_initial', 'last_name', 'birthday', 'gender', 'mobile_number', 'email', 'address', 'rotary_id', 'profile_picture', 'member_at'];

    protected $hidden = ['password'];
    
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function payment()
    {
        return $this->belongsTo(CashReceipt::class,'id','rotary_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function getAgeAttribute()
    {
        if ($this->birthday) {
            return now()->diffInYears(Carbon::parse($this->birthday));
        }
        return null;
    }

    public function getJoinedAgeAttribute()
    {
        if ($this->member_at) {
            return now()->diffInYears(Carbon::parse($this->member_at));
        }
        return null;
    }

    public function getIsRuleOfEightyFiveAttribute()
    {
        if ($this->member_at) {
            return $this->age + now()->diffInYears($this->member_at) >= 85;
        }
        return false;
    }
}