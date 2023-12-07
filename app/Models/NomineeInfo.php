<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomineeInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'name', 'phone', 'dob', 'relation_id', 'kyc_type_id', 'card_number', 'front_image', 'back_image'
    ];

    public function kycType()
    {
        return $this->belongsTo(Payload::class, 'kyc_type_id');
    }

    public function relation()
    {
        return $this->belongsTo(Payloads::class, 'relation_id');
    }
}
