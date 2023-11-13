<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomineeInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'phone', 'dob', 'relation_id', 'kyc_type_id', 'card_number'
    ];
}
