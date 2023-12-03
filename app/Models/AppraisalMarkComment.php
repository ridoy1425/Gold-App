<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalMarkComment extends Model
{
    use HasFactory;

    protected $fillable = ['appraisal_id', 'type', 'type_id', 'mark', 'comment'];
}
