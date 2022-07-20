<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
            "path" => $this->path,
            "questions" => QuestionResource::collection($this->questions->where('questiontype_id', 1)->sortBy('order'))
        ];
    }
}
