<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class PostService
{

    public function __construct(Image $image)
    {
        $this->image = $image;
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
        // foreach ($images as $image) {
        //     $filename = $image->hashName();
        //     $this->image->storeImage($image, $id, $filename);
        // }
    }
}
