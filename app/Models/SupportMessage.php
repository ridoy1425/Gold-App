<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    use HasFactory;
    protected $table = "support_messages";
    protected $fillable = ['name', 'email', 'subject', 'message'];
}
