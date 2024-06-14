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
        'email',
        'non_warwick_student',
        'subject',
        'contact',
        'caution',
    ];
}
