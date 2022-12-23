<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerPostRequest extends FormRequest
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
            'questionId' => ['required', 'integer', 'numeric', 'min:1'],
            'solicitudeId' => ['required', 'integer', 'numeric', 'min:1'],
            'value' => ['required', 'string'],
        ];
    }
}
