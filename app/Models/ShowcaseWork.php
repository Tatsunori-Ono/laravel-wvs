<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowcaseWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'showcase_item_id',
        'file_path',
    ];

    public function showcaseItem()
    {
        return $this->belongsTo(ShowcaseItem::class);
    }
}
