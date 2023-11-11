<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalInfo extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'degree', 'institute', 'duration_from', 'duration_to', 'grade', 'area'];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
