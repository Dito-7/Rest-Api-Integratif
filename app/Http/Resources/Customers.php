<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customers extends JsonResource
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
            'customerNumber' => $this->customerNumber,
            'customerName' => $this->customerName,
            'contactLastName' => $this->contactLastName,
            'contactFirstName' => $this->contactFirstName,
            'phone' => $this->phone,
            'addressLine1' => $this->addressLine1,
            'addressLine2' => $this->addressLine2,
            'city' => $this->city,
            'state' => $this->state,
            'postalCode' => $this->postalCode,
            'country' => $this->country,
            'salesRepEmployeeNumber' => $this->salesRepEmployeeNumber,
            'creditLimit' => $this->creditLimit,
        ];
    }
}
