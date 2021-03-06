<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\User;
use App\Services\PostService;
use App\Services\PutService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{

    public function __construct(PostService $postService, OrderItems $order, PutService $putService, Cart $cart)
    {
        $this->postService = $postService;
        $this->putService = $putService;
        $this->order = $order;
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order =  Invoice::all();
        return response([
            'data' => $order,
            'message' => 'success',
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->postService->addOrder($request->recipient_id);

        return response([
            'message' => 'Product successfully ordered',
            'status' => Response::HTTP_CREATED,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $cart = Cart::onlyTrashed()->where('transaction_id', $id)->first();

        $user = User::find($cart->user_id);

        $item = Cart::onlyTrashed()->where('transaction_id', $id)->get();
        // dd($item);
        return InvoiceResource::collection($item);

        $data = [
            'user' => $user,
            'cart' => Cart::onlyTrashed()->where('transaction_id', $id)->get(),
        ];

        return response([
            'data' => $data,
            'message' => 'success',
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function checkOrder(Request $request)
    {
        $this->putService->updateCart($request);

        return response([
            'message' => 'success',
            'status' => Response::HTTP_OK,
        ]);
    }
}
