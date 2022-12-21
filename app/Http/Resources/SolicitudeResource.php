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
            "form_id" => $this->form_id,
            "period_id" => $this->period_id,
            "period_start" => $this->period->start_date,
            "period_end" => $this->period->end_date,
            "period_label" => $this->period->label,
            "username" => $this->user->username,
            "status" => $this->status,
            "scholar_course" => $this->form->scholar_course,
            "scholar_level" => $this->form->scholar_level,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
