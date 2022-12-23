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
            "frontendName" => $this->field->frontend_name,
            "hidden" => $this->hidden,
            "blocked" => $this->blocked,
            "updatedAt" => $this->updated_at,
        ];
    }
}
