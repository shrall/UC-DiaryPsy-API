<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "status" => $this->status,
            "order" => $this->order,
            "price" => $this->price,
            "path" => $this->path,
            "color_hex" => $this->color_hex,
            "characters" => $this->characters->sortBy('order')->toArray()
        ];
    }
}
