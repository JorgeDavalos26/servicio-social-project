<?php

namespace App\Http\Requests;

use App\Rules\Boolean;
use Illuminate\Foundation\Http\FormRequest;

class PeriodGetRequest extends FormRequest
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
            'startDate' => ['sometimes', 'required', 'date', 'date_format:Y-m-d'],
            'endDate' => ['sometimes', 'required', 'date', 'date_format:Y-m-d', 'after_or_equal:startDate'],
            'orderBy' => ['sometimes', 'required', new Boolean]
        ];
    }
}
