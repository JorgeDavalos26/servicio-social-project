<?php

namespace App\Http\Requests;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use App\Enums\SolicitudeStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SolicitudesPostRequest extends FormRequest
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
            'userId' => ['sometimes', 'required', 'integer', 'numeric', 'min:1'],
            'formId' => ['required', 'integer', 'numeric', 'min:1'],
            'status' => ['sometimes', 'required', new Enum(SolicitudeStatus::class)],
//            'scholarLevel' => ['required_with:scholarCourse', new Enum(ScholarLevel::class)],
//            'scholarCourse' => ['required_with:scholarLevel', new Enum(ScholarCourse::class)],
//            'periodId' => ['required_without_all:scholarLevel,scholarCourse', 'integer', 'numeric', 'min:1'],
        ];
    }
}
