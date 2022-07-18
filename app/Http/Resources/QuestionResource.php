<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            "question" => $this->question,
            "order" => $this->order,
            "path" => $this->path,
            "quiz_id" => $this->quiz_id,
            "questiontype_id" => $this->questiontype_id,
            "questiontype" => $this->questiontype
        ];
    }
}
