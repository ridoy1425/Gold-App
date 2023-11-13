<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'gender_id', 'dob', 'occupation', 'marital_status_id', 'profile_image', 'kyc_type_id',
        'card_number', 'front_image', 'back_image'
    ];

    protected $cast = [
        'dob' => 'datetime',
    ];
}
