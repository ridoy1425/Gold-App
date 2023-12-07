<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileBanking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'operator_id', 'account_number', 'account_name'];
}
