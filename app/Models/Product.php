<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'oem_code',
        'internal_code',
        'thumb'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_product', 'product_id', 'car_id');
    }
}
