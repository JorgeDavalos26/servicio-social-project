<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SolicitudeResource extends JsonResource
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
            "user_id" => $this->user_id,
            "username" => $this->user->username,
            "form_id" => $this->form_id,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "type" => $this->form->type,
            "level" => $this->form->level,
        ];
    }
}
