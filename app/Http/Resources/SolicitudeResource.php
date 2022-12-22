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
            "form" => new FormResource($this->whenLoaded('form')),
            "period" => new PeriodResource($this->whenLoaded('period')),
            "username" => $this->user->username,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
