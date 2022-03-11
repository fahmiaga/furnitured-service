<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['product_id', 'user_id', 'quantity', 'shipping_cost', 'courier'];
    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function addNewCart($request)
    {
        $this->create([
            'product_id' => $request->product_id,
            'user_id' => auth()->user()->id,
            'quantity' => $request->quantity,
        ]);
    }

    public function getCartByuserId()
    {
        return $this->with(['product'])->where('user_id', auth()->user()->id)->get();
    }

    public function getCart($id)
    {
        return $this->where('product_id', $id)->where('user_id', auth()->user()->id)->first();
    }
}
