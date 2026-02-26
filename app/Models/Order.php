<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'status',
        'order_source',
        'sub_total',
        'discount',
        'grand_total'
    ];

    public function details()
{
    return $this->hasOne(\App\Models\OrderDetail::class);
}

public function items()
{
    return $this->hasMany(\App\Models\OrderProduct::class);
}

}
