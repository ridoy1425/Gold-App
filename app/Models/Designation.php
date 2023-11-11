<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = ['label_id', 'designation', 'designation_bn'];

    public function label()
    {
        return $this->belongsTo(DesignationLabel::class, 'label_id', 'id');
    }
}
