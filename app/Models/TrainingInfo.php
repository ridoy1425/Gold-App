<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  TrainingInfo extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'training', 'institute', 'org_by', 'topic', 'duration_from', 'duration_to'];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
