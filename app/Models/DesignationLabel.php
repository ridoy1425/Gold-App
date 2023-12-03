<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationLabel extends Model
{
    use HasFactory;

    protected $fillable = ['label'];

    public function designation()
    {
        return $this->hasOne(Designation::class, 'designation_label_id', 'id');
    }
}
