<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KycInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'kyc_type_id', 'card_number', 'front_image', 'back_image',
    ];
}
