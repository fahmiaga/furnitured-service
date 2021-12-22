<?php

namespace App\Models;

use App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'price', 'description', 'weight', 'category_id'];

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItems::class);
    }
}
