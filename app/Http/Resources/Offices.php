<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Offices extends JsonResource
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
            'officeCode' => $this->officeCode,
            'city' => $this->city,
            'phone' => $this->phone,
            'addressLine1' => $this->addressLine1,
            'addressLine2' => $this->addressLine2,
            'state' => $this->state,
            'country' => $this->country,
            'postalCode' => $this->postalCode,
            'territory' => $this->territory,
        ];
    }
}
