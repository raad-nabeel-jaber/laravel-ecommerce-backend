<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'image',
    ];


        public function users()
    {
        return $this->belongsToMany(User::class,'user_product')->withPivot('quantity')->withTimestamps();
    }

        public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}
