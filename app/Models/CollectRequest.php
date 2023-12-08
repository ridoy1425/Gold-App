<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectRequest extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'collect_type', 'amount', 'gold', 'method', 'status'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
