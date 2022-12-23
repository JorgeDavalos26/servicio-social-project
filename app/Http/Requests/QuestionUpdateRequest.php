<?php

namespace App\Http\Requests;

use App\Rules\Boolean;
use Illuminate\Foundation\Http\FormRequest;

class QuestionUpdateRequest extends FormRequest
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
            'fieldId' => ['sometimes', 'required', 'integer', 'numeric', 'min:1'],
            'formId' => ['sometimes', 'required', 'integer', 'numeric', 'min:1'],
            'blocked' => ['sometimes', 'required', new Boolean],
            'hidden' => ['required_without_all:fieldId,formId,blocked', new Boolean],
        ];
    }
}
