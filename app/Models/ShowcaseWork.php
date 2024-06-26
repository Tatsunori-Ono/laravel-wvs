<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowcaseWork extends Model
{
    use HasFactory;

    /**
     * 一括割り当て可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'showcase_item_id',
        'file_path',
    ];

    /**
     * ShowcaseWork と ShowcaseItem モデルの関係性を定義する。
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function showcaseItem()
    {
        return $this->belongsTo(ShowcaseItem::class);
    }
}
