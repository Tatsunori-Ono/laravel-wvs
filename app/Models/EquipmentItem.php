<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_type',
        'manufacturer',
        'category',
        'location_stored',
        'description',
        'purchase_date',
        'quantity',
        'rented_quantity',
        'max_rental_days',
        'price',
        'rental_count',
        'average_rating',
    ];

    public function images()
    {
        return $this->hasMany(EquipmentImage::class);
    }

    public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites', 'equipment_item_id', 'user_id')->withTimestamps();
}
}

