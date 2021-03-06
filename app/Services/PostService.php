<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Models\Recipient;

use function GuzzleHttp\Promise\all;

// use App\Http\Controllers\Midtrans\CoreApi;


class PostService
{

    public function __construct(Image $image, Cart $cart, Order $order, Recipient $recipient, Category $category)
    {
        $this->image = $image;
        $this->cart = $cart;
        $this->order = $order;
        $this->recipient = $recipient;
        $this->category = $category;
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
        $this->cart->addNewCart($request);
    }

    public function AddOrder($recipient_id)
    {
        $this->order->addNewOrder($recipient_id);
    }

    public function postRecipient($data)
    {
        $this->recipient->addRecipient($data);
    }

    public function addCategory($request)
    {
        return  $this->category->create($request->all());
    }
}
