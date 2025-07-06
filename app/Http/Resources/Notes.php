<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Notes extends JsonResource
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
            "title"=>$this->title,
            "semester"=>$this->semester->title,
            "category"=>$this->category->name,
            "featured_image"=>asset($this->photo),
            "doc"=>asset($this->document)
        ];
    }
}
