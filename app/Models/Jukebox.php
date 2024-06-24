<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jukebox extends Model
{
    use HasFactory;

    protected $fillable = ['youtube_url', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
