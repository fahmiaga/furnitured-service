<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Product;

class PostService
{

    public function __construct(Image $image, Cart $cart)
    {
        $this->image = $image;
        $this->cart = $cart;
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
}
