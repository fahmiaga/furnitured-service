<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Controllers\Midtrans\CoreApi;
use App\Http\Resources\PaymentResource;
use App\Models\Cart;
use App\Models\Order;

class PaymentController extends Controller
{

    public function __construct(PostService $postService, Order $order, Cart $cart)
    {
        $this->postService = $postService;
        $this->order = $order;
        $this->cart = $cart;
    }

    public function buyProduct(Request $request)
    {
        try {
            $result = null;
            $payment_method = $request->payment_method;
            $order_id = 'CXS' . date('YmdHis');
            $total_mount = $this->order->getOrders()->sum('price');
            $transaction = [
                "transaction_details" => [
                    "gross_amount" => $total_mount,
                    "order_id" => $order_id
                ],
                "customer_details" => [
                    "email" => auth()->user()->email,
                    "first_name" => auth()->user()->first_name,
                    "last_name" => auth()->user()->last_name,
                    "phone" => auth()->user()->phone
                ],
                "item_details" => PaymentResource::collection($this->cart->getCartByUserId())
            ];
            switch ($payment_method) {
                case 'bank_transfer':
                    $result = self::chargeBankTransfer($order_id, $total_mount, $transaction);
                    break;
                case 'credit_card':
                    # code...
                    break;

                default:
                    # code...
                    break;
            }
            return $result;
        } catch (\Throwable $th) {
            dd($th);
            return ['code' => 0, 'message' => 'Terjadi kesalahan 01'];
        }
    }

    static function chargeBankTransfer($order_id, $total_mount, $transaction_object)
    {
        try {
            $transaction = $transaction_object;
            $transaction['payment_type'] = 'bank_transfer';
            $transaction['bank_transfer'] = [
                "bank" => "bca",
                "va_number" => "111111",
            ];

            $charge = CoreApi::charge($transaction);
            if (!$charge) {
                return ['code' => 0, 'message' => 'Terjadi kesalahan 02'];
            }

            $order = new Order();
            $order->invoice = $order_id;
            $order->transaction_id = $charge->transaction_id;
            $order->total_cost = $order->getOrders()->sum('price');
            $order->status = "PENDING";

            if (!$order->save())
                return false;
            return ['code' => 1, 'message' => 'Success', 'result' => $charge];
        } catch (\Exception $e) {
            dd($e);
            return ['code' => 0, 'message' => 'Terjadi kesalahan 03'];
        }
    }

    // public function itemFormatter()
    // {
    //     $items = $this->order->getOrders();
    //     $newItem = [];
    //     foreach ($items as $item) {

    //         $newArray = [
    //             "id" => (string) $item->id,
    //             "price" => (int) $item->price,
    //             "quantity" => 1,
    //             "name" => $item->name
    //         ];
    //         array_push($newItem, (array)$newArray);
    //     }

    //     return (array)$newItem;
    // }
}
