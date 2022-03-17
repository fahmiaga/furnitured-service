<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['quantity', 'product_id', 'user_id', 'recipient_id'];

    public function addNewOrder($recipient_id)
    {
        $orders = $this->getOrders();
        foreach ($orders as $order) {
            $this->create([
                'product_id' => $order->product_id,
                'user_id' => auth()->user()->id,
                'recipient_id' => $recipient_id,
                'quantity' => $order->quantity
            ]);
        }
    }

    public function getOrders()
    {
        return Cart::join('products', 'carts.product_id', '=', 'products.id')
            ->select('products.name', 'products.price', 'products.weight', 'carts.quantity', 'carts.shipping_cost')
            ->where('carts.user_id', auth()->user()->id)
            ->get();
    }

    public function totalCost()
    {
        $orders = $this->getOrders();
        // dd('order =>', $orders);
        $total = 0;
        foreach ($orders as $order) {
            $total += ($order->price * $order->quantity) + $order->shipping_cost;
        }
        return $total;
    }
}
