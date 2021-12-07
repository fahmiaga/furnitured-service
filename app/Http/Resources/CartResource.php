<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $images = new ProductResource($this->product);
        return [
            'cart_id' => $this->id,
            'name' => $this->product->name,
            'qty' => $this->product->qty,
            'price' => $this->product->price,
            'description' => $this->product->description,
            'images' => $images->images,
        ];
    }
}
