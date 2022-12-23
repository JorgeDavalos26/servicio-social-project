<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerUpdateRequest extends FormRequest
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
            'questionId' => ['sometimes', 'required', 'integer', 'numeric', 'min:1'],
            'solicitudeId' => ['sometimes', 'required', 'integer', 'numeric', 'min:1'],
            'value' => ['required_without_all:questionId,solicitudeId', 'string'],
        ];
    }
}
