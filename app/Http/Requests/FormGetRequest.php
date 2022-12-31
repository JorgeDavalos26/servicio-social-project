<?php

namespace App\Http\Requests;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class FormGetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules1 = ['sometimes', 'required', 'min:1', 'integer', 'numeric'];

        return [
            'paginated' => ['required_with:perPage,page', 'boolean'],
            'perPage' => $rules1,
            'page' => $rules1,

            'scholar_level' => [new Enum(ScholarLevel::class)],
            'scholar_course' => [new Enum(ScholarCourse::class)],
        ];
    }
}
