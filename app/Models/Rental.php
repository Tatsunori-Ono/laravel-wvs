<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    /**
     * 一括割り当て可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'equipment_item_id',
        'quantity',
        'return_by',
    ];

    /**
     * 日付として扱う属性
     *
     * @var array
     */
    protected $dates = [
        'return_by',
    ];

    /**
     * Rental と User モデルの関係性を定義する。
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Rental と EquipmentItem モデルの関係性を定義する。
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipmentItem()
    {
        return $this->belongsTo(EquipmentItem::class);
    }
}
