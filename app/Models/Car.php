<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'automaker_id',
        'name',
        'model',
        'engine',
        'initial_year',
        'final_year'
    ];

    public function automakers()
    {
        return $this->hasOne(Automaker::class, 'automaker_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'car_product', 'car_id', 'product_id');
    }
}
