<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
// use App\Http\Controllers\Midtrans\CoreApi;


class PostService
{

    public function __construct(Image $image, Cart $cart, Order $order)
    {
        $this->image = $image;
        $this->cart = $cart;
        $this->order = $order;
    }

    public function post($request)
    {
        $product = $this->storeProduct($request);

        $this->storeImage($request, $product->id);

        return $product;
    }


    public function storeProduct($request)
    {
        return Product::create($request->all());
    }


    public function storeImage($request, $id)
    {

        $images = $request->file('image_name');

        $this->image->addMultipleImage($images, $id);
    }

    public function addToCart($request)
    {
        $this->cart->addNewCart($request->product_id);
    }

    public function AddOrder($recipient_id)
    {
        $this->order->addNewOrder($recipient_id);
    }

    // public function buyProduct($request)
    // {
    //     $result = null;
    //     $payment_method = $request->payment_method;
    //     $order_id = 'CXS' . date('YmdHis');
    //     $total_mount = $this->order->getOrders()->sum('price');
    //     // dd($this->cart->getCartByuserId());
    //     $transaction = [
    //         "transaction_details" => [
    //             "gross_amount" => $total_mount,
    //             "order_id" => $order_id
    //         ],
    //         "customer_details" => [
    //             "email" => auth()->user()->email,
    //             "first_name" => auth()->user()->first_name,
    //             "last_name" => auth()->user()->last_name,
    //             "phone" => auth()->user()->phone
    //         ],
    //         "item_details" => array([
    //             "id" => "1388998298204",
    //             "price" => 90000,
    //             "quantity" => 1,
    //             "name" => "Panci Miako"
    //         ], [
    //             "id" => "1388998298202",
    //             "price" => 40000,
    //             "quantity" => 1,
    //             "name" => "Ayam Geprek"
    //         ]),
    //     ];
    //     switch ($payment_method) {
    //         case 'bank_transfer':
    //             $result = self::chargeBankTransfer($order_id, $total_mount, $transaction);
    //             break;
    //         case 'credit_card':
    //             # code...
    //             break;

    //         default:
    //             # code...
    //             break;
    //     }
    //     return $result;
    // }

    // static function chargeBankTransfer($order_id, $total_mount, $transaction_object)
    // {
    //     try {
    //         $transaction = $transaction_object;
    //         $transaction['payment_type'] = 'bank_transfer';
    //         $transaction['bank_transfer'] = [
    //             "bank" => "bca",
    //             "va_number" => "111111",
    //         ];

    //         $charge = CoreApi::charge($transaction);
    //         if (!$charge) {
    //             return ['code' => 0, 'message' => 'Terjadi kesalahan 02'];
    //         }

    //         $order = new Order();
    //         $order->invoice = $order_id;
    //         $order->transaction_id = $charge->transaction_id;
    //         $order->status = "PENDING";

    //         if (!$order->save())
    //             return false;
    //         return ['code' => 1, 'message' => 'Success', 'result' => $charge];
    //     } catch (\Exception $e) {
    //         return ['code' => 0, 'message' => 'Terjadi kesalahan 03'];
    //     }
    // }
}
