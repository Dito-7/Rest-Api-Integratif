<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Orders extends JsonResource
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
            'orderNumber' => $this->orderNumber,
            'orderDate' => $this->orderDate,
            'requiredDate' => $this->requiredDate,
            'shippedDate' => $this->shippedDate,
            'status' => $this->status,
            'comments' => $this->comments,
            'customerNumber' => $this->customerNumber,
        ];
    }
}
