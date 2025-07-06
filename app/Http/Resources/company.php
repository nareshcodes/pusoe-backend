<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class company extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "name"=>$this->name,
            "address"=>$this->address,
            "phone"=>$this->phone,
            "email"=>$this->email,
            "logo"=>asset($this->logo),
            "website"=>$this->website,
        ];
    }
}
