<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'evaluation_date', 'period_from', 'period_to', 'letter_send', 'letter_sent_date'];

    public function duty_responsibility()
    {
        return $this->hasMany(AppraisalMarkComment::class, 'appraisal_id')->where('type', 'duty');
    }

    public function attitude_behavior()
    {
        return $this->hasMany(AppraisalMarkComment::class, 'appraisal_id')->where('type', 'attitude');
    }

    public function hr_administrative()
    {
        return $this->hasMany(AppraisalMarkComment::class, 'appraisal_id')->where('type', 'hr');
    }

    public function finance()
    {
        return $this->hasMany(AppraisalMarkComment::class, 'appraisal_id')->where('type', 'finance');
    }

    public function evaluation_comment()
    {
        return $this->hasMany(AppraisalSuccessFail::class, 'appraisal_id')->where('type', 'evaluation');
    }

    public function limitation_comment()
    {
        return $this->hasMany(AppraisalSuccessFail::class, 'appraisal_id')->where('type', 'limitation');
    }

    public function development_comment()
    {
        return $this->hasMany(AppraisalSuccessFail::class, 'appraisal_id')->where('type', 'development');
    }

    public function staff_comment()
    {
        return $this->hasOne(EvaluatorComment::class, 'appraisal_id')->whereNull('appraisal_evaluator_id');
    }

    public function evaluator_comment()
    {
        return $this->hasMany(EvaluatorComment::class, 'appraisal_id')->whereNotNull('appraisal_evaluator_id');
    }
}
