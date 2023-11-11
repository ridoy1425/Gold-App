<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionInfo extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'designation_id', 'effective_date', 'salary', 'salary_grade', 'pay_step'];

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
