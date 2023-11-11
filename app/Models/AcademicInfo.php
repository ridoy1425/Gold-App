<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicInfo extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'employee_id', 'degree_id', 'institute', 'pass_yr', 'grade', 'discipline', 'primary_id'];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function degree()
    {
        return $this->belongsTo(Payload::class, 'degree_id');
    }
}
