<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryInfo extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'salary_grade', 'basic_salary', 'conveyance', 'arban_allowance', 'pay_step', 'house_rent', 'medical_allowance', 'note', 'contractual_salary'];
}
