<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jukebox extends Model
{
    use HasFactory;

    protected $fillable = ['youtube_url'];
}
