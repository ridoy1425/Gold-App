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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kycType()
    {
        return $this->belongsTo(Payload::class, 'kyc_type_id');
    }
}
