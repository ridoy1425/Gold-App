<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluatorComment extends Model
{
    use HasFactory;
    protected $fillable = ['appraisal_id', 'appraisal_evaluator_id', 'comment'];
}
