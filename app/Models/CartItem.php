<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    /**
     * このモデルで割り当て可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'equipment_item_id',
        'quantity',
        'rental_days'
    ];

    /**
     * カートアイテムに関連付けられている機器アイテムを取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipmentItem()
    {
        return $this->belongsTo(EquipmentItem::class);
    }
}
