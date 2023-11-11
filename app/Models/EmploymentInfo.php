<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentInfo extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'org_name', 'org_address', 'last_position', 'service_from', 'service_to', 'separation'];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
