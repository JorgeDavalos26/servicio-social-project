<?php

namespace App\Http\Requests;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use App\Enums\SolicitudeStatus;
use App\Rules\Boolean;
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
        return [
            'paginated' => ['required_with:perPage,page', new Boolean],
            'perPage' => ['sometimes', 'required', 'min:1', 'integer', 'numeric'],
            'page' => ['sometimes', 'required', 'min:1', 'integer', 'numeric'],
            'scholarLevel' => ['required_with:scholarCourse', new Enum(ScholarLevel::class)],
            'scholarCourse' => ['required_with:scholarLevel', new Enum(ScholarCourse::class)],
            'status' => ['sometimes', new Enum(SolicitudeStatus::class)],
            'userId' => ['sometimes', 'required', 'min:1', 'integer', 'numeric'],
            'periodId' => ['sometimes', 'required', 'min:1', 'integer', 'numeric'],
            'orderBy' => ['sometimes', 'required', new Boolean]
        ];
    }
}
