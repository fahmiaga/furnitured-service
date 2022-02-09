<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Cart;
use App\Models\Product;
use App\Services\PostService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{

    public function __construct(PostService $postService, Cart $cart)
    {
        $this->postService = $postService;
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = $this->cart->getCartByUserId();
        return ItemResource::collection($carts);
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
        $cart = $this->cart->getCart($request->product_id);
        $product = Product::where('id', $request->product_id)->first();


        if ($request->quantity >  $product->quantity) {
            return response([
                'message' => 'Request quantity can not be greater than product quantity',
                'status' => Response::HTTP_BAD_REQUEST,
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity
            ]);

            return response([
                'message' => 'Cart quantity updated',
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
        $this->postService->addToCart($request);

        return response([
            'message' => 'Product added to cart',
            'status' => Response::HTTP_CREATED
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        // dd($cart->getCartByuserId());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        // dd($cart);
        Cart::destroy($cart->id);

        return response([
            'message' => 'Product deleted from cart',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }
}
