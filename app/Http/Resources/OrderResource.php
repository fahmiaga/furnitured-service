<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'total_cost' => $this->total_cost,
            'start_booking' => $this->start_booking,
            'end_booking' => $this->end_booking,
            'items' => ItemResource::collection($this->order_items),
        ];
    }
}
