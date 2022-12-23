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
            "status" => $this->status,
            "userId" => $this->user_id,
            "userUsername" => $this->user->username,
            "userEmail" => $this->user->email,
            "formId" => $this->form_id,
            "formLabel" => $this->form->label,
            "formScholarCourse" => $this->form->scholar_course,
            "formScholarLevel" => $this->form->scholar_level,
            "periodId" => $this->period_id,
            "periodStart" => $this->period->start_date,
            "periodEnd" => $this->period->end_date,
            "periodLabel" => $this->period->label,
            "updatedAt" => $this->updated_at,
        ];
    }
}
