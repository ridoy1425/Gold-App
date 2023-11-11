<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'name', 'dob', 'age', 'relation', 'occupation'];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
