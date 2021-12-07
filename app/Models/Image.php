<?php

namespace App\Models;

use App\Models\Product;

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
            $filename = $image->hashName();
            $this->storeImage($image, $id, $filename);
        }
    }

    public function storeImage($image, $id, $filename)
    {
        return  $this->create([
            'product_id' => $id,
            'image_name' => $image->store('post-images'),
            'url' => "http://127.0.0.1:8000/storage/post-images/$filename"
        ]);
    }

    // get image product
    public function getImageProduct($id)
    {
        return $this->where('product_id', $id)->get();
    }
}
