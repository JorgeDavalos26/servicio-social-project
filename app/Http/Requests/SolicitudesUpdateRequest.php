<?php

namespace App\Http\Requests;

use App\Enums\SolicitudeStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SolicitudesUpdateRequest extends FormRequest
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
        $rules1 = ['required', 'integer', 'numeric', 'min:1'];

        return [
            'userId' => $rules1,
            'formId' => $rules1,
            'periodId' => $rules1,
            'status' => ['required', new Enum(SolicitudeStatus::class)]
        ];
    }
}
