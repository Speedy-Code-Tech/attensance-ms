<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'pdf_path', 'thumbnail_path', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}