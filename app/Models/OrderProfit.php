<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProfit extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'date', 'status'];

    public function order()
    {
        return $this->belongsTo(OrderProfit::class, "order_id");
    }
}
