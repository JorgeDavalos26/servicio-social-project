<?php

namespace App\Http\Requests;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SolicitudesGetRequest extends FormRequest
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
        $rules1 = ['sometimes', 'required', 'min:1', 'integer', 'numeric'];

        return [
            'paginated' => ['required_with:perPage,page', 'boolean'],
            'perPage' => $rules1,
            'page' => $rules1,
            'user_id' => $rules1,
            'period_id' => $rules1,

            'scholar_level' => ['sometimes', 'required', new Enum(ScholarLevel::class)],
            'scholar_course' => ['sometimes', 'required', new Enum(ScholarCourse::class)],
        ];
    }
}
