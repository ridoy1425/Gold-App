<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomineeInfo extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'name', 'dob', 'relation', 'occupation', 'address', 'amount'];
}
