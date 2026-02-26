<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'customer_name',
        'phone',
        'address'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
