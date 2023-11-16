<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'account_name', 'account_number', 'bank_name', 'bank_code', 'branch_name', 'branch_location', 'routing_number', 'account_type'];
}
