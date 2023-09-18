<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'is_makeup'];


    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

}