<?php

namespace App\Http\Requests;

use App\Rules\IsLatinName;
use App\Rules\NotBadWord;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AuthRegisterRequest extends FormRequest
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
            'username' => ['required', 'string', 'min:2', 'max:40', new IsLatinName, new NotBadWord],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::defaults(), 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }
}
