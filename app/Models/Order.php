<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'total_cost', 'start_booking', 'end_booking'];


    public function order_items()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function addNewOrder()
    {
        $order =   $this->addOrder();
        $this->addOrderItem($order->id);
    }

    public function addOrder()
    {
        $end_booking = new DateTime('tomorrow');

        $total_cost = $this->getOrders()->sum('price');

        return $this->create([
            'total_cost' => $total_cost,
            'start_booking' => date("Y-m-d h:i:s"),
            'end_booking' => $end_booking->format("Y-m-d h:i:s"),
        ]);
    }

    public function addOrderItem($order_id)
    {
        $orders = $this->getOrders();
        foreach ($orders as $order) {
            OrderItems::create([
                'order_id' => $order_id,
                'product_id' => $order->product_id,
                'user_id' => auth()->user()->id,
            ]);
        }
    }

    public function getOrders()
    {
        return Product::join('carts', 'products.id', '=', 'carts.product_id')
            ->select('*')
            ->where('carts.user_id', auth()->user()->id)
            ->get();
    }
}
