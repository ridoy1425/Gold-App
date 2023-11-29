<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'order_id', 'gold_qty', 'price', 'profit_percentage', 'profit_amount', 'delivery_time', 'delivery_date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderProfit()
    {
        return $this->hasMany(OrderProfit::class, 'order_id');
    }
}
