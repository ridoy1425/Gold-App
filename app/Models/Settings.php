<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'gold_price', 'header_text', 'sub_header', 'buying_price', 'profit_percentage', 'return_period'];
}
