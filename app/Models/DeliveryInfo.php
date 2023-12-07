<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryInfo extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'address', 'postal_code', 'recipient_name', 'additional_info', 'phone_number'];
}
