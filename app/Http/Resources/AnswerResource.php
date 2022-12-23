<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
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
            "questionId" => $this->question_id,
            "questionFrontendName" => $this->question->field->frontend_name,
            "questionHidden" => $this->question->hidden,
            "questionBlocked" => $this->question->blocked,
            "solicitudeId" => $this->solicitude_id,
            "value" => $this->value,
            "updatedAt" => $this->updated_at,
        ];
    }
}
