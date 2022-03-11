<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'first_name' =>  $this->user->first_name,
            'last_name' =>  $this->user->last_name,
            'phone' =>  $this->user->phone,
            'email' =>  $this->user->email,
            'product_name' => $this->product->name,
            'description' => $this->product->description,
            'price' => $this->product->price,
        ];
    }
}
