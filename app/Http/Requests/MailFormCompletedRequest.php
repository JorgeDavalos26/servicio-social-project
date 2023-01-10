<?php

namespace App\Http\Requests;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class MailFormCompletedRequest extends FormRequest
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
            'to' => ['sometimes', 'required', 'email', 'exists:users,email'],
            'level' => ['required', 'string', new Enum(ScholarLevel::class)],
            'course' => ['required', 'string', new Enum(ScholarCourse::class)]
        ];
    }
}
