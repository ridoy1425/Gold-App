<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalEvaluator extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'category_id', 'evaluator_id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(AppraisalCategory::class, 'category_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(EmployeeInfo::class, 'evaluator_id');
    }
}
