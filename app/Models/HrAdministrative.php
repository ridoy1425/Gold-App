<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrAdministrative extends Model
{
    use HasFactory;

    protected $fillable = ['branch_category_id ', 'order', 'marks', 'hr_administrative'];
}
