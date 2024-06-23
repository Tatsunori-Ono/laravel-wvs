<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'equipment_item_id',
        'quantity',
        'rental_days'
    ];

    public function equipmentItem()
    {
        return $this->belongsTo(EquipmentItem::class);
    }
}
