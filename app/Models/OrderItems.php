<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'user_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    public function getOrderByUser()
    {
        return $this->with(['product', 'order'])->where('user_id', auth()->user()->id)->get();
    }
}
