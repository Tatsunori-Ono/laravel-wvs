<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentImage extends Model
{
    use HasFactory;

    /**
     * 一括割り当て可能な属性
     *
     * @var array
     */
    protected $fillable = ['equipment_item_id', 'image_path'];

    /**
     * EquipmentImage と EquipmentItem モデルの関係性を定義する。
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipmentItem()
    {
        return $this->belongsTo(EquipmentItem::class);
    }
}
