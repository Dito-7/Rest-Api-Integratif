<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Orderdetails extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'orderNumber' => $this->orderNumber,
            'productCode' => $this->productCode,
            'quantityOrdered' => $this->quantityOrdered,
            'priceEach' => $this->priceEach,
            'orderLineNumber' => $this->orderLineNumber,
        ];
    }
}
