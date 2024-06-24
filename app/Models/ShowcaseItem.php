<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowcaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'description',
        'user_id',
        'approved',
    ];

    public function works()
    {
        return $this->hasMany(ShowcaseWork::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
