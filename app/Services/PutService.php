<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;

class PutService
{

    public function __construct(Image $image, Cart $cart, Product $product)
    {
        $this->image = $image;
        $this->cart = $cart;
        $this->product = $product;
    }

    public function put($request, $product)
    {
        $newProduct = $this->updateProduct($request, $product);

        // $this->storeImage($request, $product->id);

        return $newProduct;
    }


    public function updateProduct($request, $product)
    {

        return $product->update($request->all());
    }


    public function storeImage($request, $id)
    {
        $images = $request->file('image_name');

        foreach ($images as $image) {
            $filename = $image->hashName();
            $this->image->storeImage($image, $id, $filename);
        }
    }

    public function updateCart($request)
    {
        $reqs = $request->all();

        foreach ($reqs as $req) {
            $cart = $this->cart->where('id', $req['cart_id'])->first();
            $product = $this->product->where('id', $cart->product_id)->first();

            if ($product->quantity < $req['quantity']) {
                return response([
                    'status' => Response::HTTP_BAD_REQUEST,
                    'message' => 'cannot add item greater than quantity'
                ], Response::HTTP_BAD_REQUEST);
            } else {
                $cart->update(['quantity' => $req['quantity']]);
            }
        }
    }

    public function putRecipient($request, $recipient)
    {
        $recipient->update($request->all());
    }

    public function updateCategory($request, $category)
    {
        $category->update($request->all());
    }
}
