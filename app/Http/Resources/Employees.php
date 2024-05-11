<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Employees extends JsonResource
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
            'employeeNumber' => $this->employeeNumber,
            'lastName' => $this->lastName,
            'firstName' => $this->firstName,
            'extension' => $this->extension,
            'email' => $this->email,
            'officeCode' => $this->officeCode,
            'reportsTo' => $this->reportsTo,
            'jobTitle' => $this->jobTitle,
        ];
    }
}
