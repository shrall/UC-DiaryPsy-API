<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "photo" => $this->photo,
            "email" => $this->email,
            "year_born" => $this->year_born,
            "phone" => $this->phone,
            "address" => $this->address,
            "institute" => $this->institute,
            "education" => $this->education,
            "religion" => $this->religion,
            "tribe" => $this->tribe,
            "city" => $this->city,
            "modules" => UserModuleResource::collection($this->modules),
            // "questions" => QuestionResource::collection($this->questions->sortBy('order'))
        ];
    }
}
