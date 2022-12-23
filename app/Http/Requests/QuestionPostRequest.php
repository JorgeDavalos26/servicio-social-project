<?php

namespace App\Http\Requests;

use App\Rules\Boolean;
use Illuminate\Foundation\Http\FormRequest;

class QuestionPostRequest extends FormRequest
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
            'fieldId' => ['required', 'integer', 'numeric', 'min:1'],
            'formId' => ['required', 'integer', 'numeric', 'min:1'],
            'hidden' => ['required', new Boolean],
            'blocked' => ['required', new Boolean]
        ];
    }
}
