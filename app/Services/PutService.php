<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Product;

class PutService
{

    public function __construct(Image $image)
    {
        $this->image = $image;
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
}
