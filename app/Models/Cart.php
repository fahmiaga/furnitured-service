<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'user_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addNewCart($cart)
    {
        $this->create([
            'product_id' => $cart,
            'user_id' => auth()->user()->id
        ]);
    }

    public function getCartByuserId()
    {
        return $this->with(['product'])->where('user_id', auth()->user()->id)->get();
    }
}
