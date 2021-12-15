<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipientResource extends JsonResource
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
            'recipient' => $this->recipient,
            'address' => $this->address,
            'phone' => $this->phone,
            'province' => $this->province,
            'district' => $this->district,
            'sub_district' => $this->sub_district,
            'zip_code' => $this->zip_code,
        ];
    }
}
