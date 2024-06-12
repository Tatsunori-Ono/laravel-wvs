<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JukeboxQueue extends Model
{
    use HasFactory;

    protected $table = 'jukebox_queue';

    protected $fillable = [
        'user_id', 'video_title', 'video_url', 'video_length', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
