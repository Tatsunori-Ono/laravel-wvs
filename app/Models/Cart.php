<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * このモデルで割り当て可能な属性
     *
     * @var array
     */
    protected $fillable = ['user_id'];

    /**
     * カートに関連付けられているアイテムを取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
