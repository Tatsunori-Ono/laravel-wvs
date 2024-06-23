<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentImage extends Model
{
    use HasFactory;

    protected $fillable = ['equipment_item_id', 'image_path'];

    public function equipmentItem()
    {
        return $this->belongsTo(EquipmentItem::class);
    }
}
