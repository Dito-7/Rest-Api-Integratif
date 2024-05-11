<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'productCode' => $this->productCode,
            'productName' => $this->productName,
            'productLine' => $this->productLine,
            'productScale' => $this->productScale,
            'productVendor' => $this->productVendor,
            'productDescription' => $this->productDescription,
            'quantityInStock' => $this->quantityInStock,
            'buyPrice' => $this->buyPrice,
            'MSRP' => $this->MSRP,
        ];
    }
}
