<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransfer extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'recipient_id', 'amount'];
}
