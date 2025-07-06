<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Books extends JsonResource
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
            "id"=>$this->id,
            "title"=>$this->title,
            "slug"=>$this->slug,
            "semester"=>$this->semester->title,
            "category"=>$this->category->name,
            "featured_image"=>asset($this->photo),
            "document"=>asset($this->document),
        ];
    }
}
