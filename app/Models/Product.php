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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public static function  filterProduct($request)
    {
        if ($request->id === null) {
            return Product::where('name', 'ILIKE', "%$request->name%")->get();
        }
        if ($request->name === null) {
            return Product::where('category_id', $request->id)->get();
        }
        if ($request->name !== null && $request->id !== null) {
            return Product::where('category_id', $request->id)->where('name', 'ILIKE', "%$request->name%")->get();
        }
    }
}
