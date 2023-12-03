<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalSuccessFail extends Model
{
    use HasFactory;
    protected $fillable = ['appraisal_id', 'type', 'comment'];
}
