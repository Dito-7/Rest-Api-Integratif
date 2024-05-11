<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Productline extends JsonResource
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
            'productLine' => $this->productLine,
            'textDescription' => $this->textDescription,
            'htmlDescription' => $this->htmlDescription,
            'image' => $this->image,
        ];
    }
}
