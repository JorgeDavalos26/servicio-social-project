<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class IsLatinName implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (!preg_match("/^[\p{Latin}]+(\s[\p{Latin}]+)*$/u", $value)) {
            $fail('The :attribute has not valid characters.');
        }
    }
}
