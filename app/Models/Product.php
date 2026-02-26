<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'tax_percent',
        'final_price',
        'image',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function rates()
    {
        return $this->hasMany(ProductRate::class, 'product_id');
    }

    public function activeRate()
{
    return $this->hasOne(ProductRate::class)->latest();
}


    public function recalcFinalPrice()
    {
        $this->final_price = $this->price + ($this->price * $this->tax_percent / 100);
        $this->save();
    }
}
