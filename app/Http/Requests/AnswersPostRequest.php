<?php

namespace App\Http\Requests;

use App\Rules\IsTypeQuestion;
use Illuminate\Foundation\Http\FormRequest;

class AnswersPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "solicitudeId" => ['required', 'integer', 'numeric', 'min:1'],
            "answers" => ['required', 'array'],
            "answers.*.questionId" => ['required', 'integer', 'numeric', 'min:1'],
            "answers.*" => [new IsTypeQuestion],
        ];
    }
}
