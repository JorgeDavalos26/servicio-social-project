<?php

namespace App\Http\Resources;

use App\Enums\TypesQuestion;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
        $answerValue = $this->value;

        if ($this->question->type == TypesQuestion::FILE) {
            if (Storage::disk('local_custom')->exists($this->value)) {
                $contents = Storage::disk("local_custom")->get($this->value);
            }
            else {
                $contents = null;
            }
            $answerValue = $contents;
        }
        else if ($this->question->type == TypesQuestion::INT) {

        }
        else if ($this->question->type == TypesQuestion::FLOAT) {

        }
        else if ($this->question->type == TypesQuestion::BOOLEAN) {

        }
        else if ($this->question->type == TypesQuestion::DATETIME) {

        }
        else if ($this->question->type == TypesQuestion::MULTIPLE) {

        }
        else if ($this->question->type == TypesQuestion::TIME) {

        }

        return [
            "id" => $this->id,
            "questionId" => $this->question_id,
            "questionFrontendName" => $this->question->field->frontend_name,
            "questionHidden" => $this->question->hidden,
            "questionBlocked" => $this->question->blocked,
            "questionRequired" => $this->question->required,
            "solicitudeId" => $this->solicitude_id,
            "value" => $answerValue,
            "updatedAt" => $this->updated_at,
        ];
    }
}
