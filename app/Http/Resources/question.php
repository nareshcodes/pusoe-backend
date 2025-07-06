<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class question extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "title"=>$this->title,
            "slug"=>$this->slug,
            "semester"=>$this->semester->title,
            "category"=>$this->category->name,
            "photo"=>asset($this->photo),
            "document"=>asset($this->document)
        ];
    }
}
