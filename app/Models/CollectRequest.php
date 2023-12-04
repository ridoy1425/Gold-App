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
        return $this->belongsTo(CollectRequest::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
