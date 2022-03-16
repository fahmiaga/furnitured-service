<?php

namespace App\Models;

use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['image_name', 'url', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function addMultipleImage($images, $id)
    {
        foreach ($images as $image) {

            $url = Cloudinary::upload($image->getRealPath(), array("folder" => "posts-image", "overwrite" => TRUE, "resource_type" => "image"))->getSecurePath();
            $image_name = Cloudinary::getPublicId();
            $this->storeImage($image_name, $id, $url);
        }
    }

    // store image
    public function storeImage($image_name, $id, $url)
    {
        return  $this->create([
            'product_id' => $id,
            'image_name' => $image_name,
            'url' => $url
        ]);
    }

    // get image product
    public function getImageProduct($id)
    {
        return $this->where('product_id', $id)->get();
    }
}
