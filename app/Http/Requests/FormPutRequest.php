<?php

namespace App\Http\Requests;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class FormPutRequest extends FormRequest
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
        return [
            'description' => 'string',
            'scholarCourse' => [new Enum(ScholarCourse::class)],
            'scholarLevel' => [new Enum(ScholarLevel::class)],
            'label' => 'string'
        ];
    }
}
