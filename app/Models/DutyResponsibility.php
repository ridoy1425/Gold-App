<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DutyResponsibility extends Model
{
    use HasFactory;

    protected $fillable = ['branch_category_id ', 'order', 'marks', 'duty_responsibility'];
}
