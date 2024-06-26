<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentItem extends Model
{
    use HasFactory;

    /**
     * 一括割り当て可能な属性
     *
     * @var array
     */
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

    /**
     * EquipmentItem と EquipmentImage モデルの関係性を定義する。
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(EquipmentImage::class);
    }

    /**
     * EquipmentItem と User モデルの多対多の関係性を定義する（お気に入り機能）。
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'equipment_item_id', 'user_id')->withTimestamps();
    }
}

