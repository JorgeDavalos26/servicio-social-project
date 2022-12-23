<?php

namespace App\Http\Requests;

use App\Rules\Boolean;
use Illuminate\Foundation\Http\FormRequest;

class QuestionGetRequest extends FormRequest
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
            'paginated' => ['required_with:perPage,page', 'boolean'],
            'perPage' => ['sometimes', 'required', 'min:1', 'integer', 'numeric'],
            'page' => ['sometimes', 'required', 'min:1', 'integer', 'numeric'],
            'formId' => ['required', 'min:1', 'integer', 'numeric'],
            'orderBy' => ['sometimes', 'required', new Boolean]
        ];
    }
}
