<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class MidtransNotifController extends Controller
{
    public function postNotif(Request $request)
    {
        try {
            $notification_body = json_decode($request->getContent(), true);
            $invoice = $notification_body['order_id'];
            $transaction_id = $notification_body['transaction_id'];
            $status_code = $notification_body['status_code'];
            $order = Invoice::where('invoice', $invoice)->where('transaction_id', $transaction_id)->first();

            if (!$order) {
                return ['code' => 1, 'message' => 'Order not found'];
            }

            switch ($status_code) {
                case '200':
                    $order->status = 'SUCCESS';
                    break;
                case '201':
                    $order->status = 'PENDING';
                    break;
                case '202':
                    $order->status = 'CANCEL';
                    break;
            }

            $order->save();
            return response('ok', 200)->header('Content-Type', 'text/plain');
        } catch (\Throwable $th) {
            return response('Not found', 404)->header('Content-Type', 'text/plain');
        }
    }
}
