<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'quantity' => $this->quantity,
            'price' => $this->product->price,
            'weight' => $this->product->weight,
            'description' => $this->product->description,
            'shipping_cost' => $this->shipping_cost,
            'courier' => $this->courier,
            'images' => ImageResource::collection($images->images),
        ];
    }
}
