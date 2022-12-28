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

        if ($this->question->field->type == TypesQuestion::FILE->value) {
            if (Storage::disk('local_custom')->exists($this->value)) {
                $relativePath = $this->value;
                $fullPath = Storage::disk('local_custom')->path($relativePath);
                $contents = Storage::disk("local_custom")->get($relativePath);
                $base64 = base64_encode($contents); // contents of file to base64
                $answerValue = 'data:'.mime_content_type($fullPath).';base64,'.$base64; // format: data:{mime};base64,{base64 data};
            }
            else {
                $answerValue = null;
            }
        }
        else if ($this->question->field->type == TypesQuestion::INT->value) {
            $answerValue = (int) $answerValue;
        }
        else if ($this->question->field->type == TypesQuestion::FLOAT->value) {
            $answerValue = (float) $answerValue;
        }
        else if ($this->question->field->type == TypesQuestion::BOOLEAN->value) {
            $answerValue = to_boolean($answerValue);
        }
        else if ($this->question->field->type == TypesQuestion::MULTIPLE->value) {
            
        }

        return [
            "id" => $this->id,
            "questionId" => $this->question_id,
            "value" => $answerValue,
            "updatedAt" => $this->updated_at,
        ];
    }
}
