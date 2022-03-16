<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Product;
use App\Models\Recipient;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class DeleteService
{

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function delete($product)
    {
        // Product::destroy($product->id);
        $this->deleteImages($product->id);
    }

    public function deleteImages($id)
    {
        $images = $this->image->getImageProduct($id);
        foreach ($images as $image) {
            // Storage::delete(substr("posts-image/$image->image_name", 12));
            Cloudinary::destroy($image->image_name);
            Image::destroy($image->id);
        }
    }

    public function deleteRecipient($recipient)
    {
        Recipient::destroy($recipient->id);
    }
}
