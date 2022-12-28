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
            "backendName" => $this->field->backend_name,
            "frontendName" => $this->field->frontend_name,
            "type" => $this->field->type,
            "hidden" => $this->hidden,
            "blocked" => $this->blocked,
            "required" => $this->required,
            "answer" => $this->answer,
            "updatedAt" => $this->updated_at
        ];
    }
}
