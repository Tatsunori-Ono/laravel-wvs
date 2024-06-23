<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'equipment_item_id',
        'quantity',
        'return_by',
    ];

    protected $dates = [
        'return_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipmentItem()
    {
        return $this->belongsTo(EquipmentItem::class);
    }
}
