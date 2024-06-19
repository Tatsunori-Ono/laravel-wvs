<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    use HasFactory;

    // フォームのname属性、一括割り当て
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'non_warwick_student',
        'subject',
        'contact',
        'caution',
    ];

    // Userモデルとの関係性
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search){
        if($search !== null) {
            $search_split = mb_convert_kana($search, 's'); //全角スペースを半角にする
            $search_split2 = preg_split('/[\s]+/', $search_split); //空白で区切る
            foreach($search_split2 as $value){
                $query->where('name', 'like', '%' .$value. '%');
            }
        }
        return $query;
    }
}
