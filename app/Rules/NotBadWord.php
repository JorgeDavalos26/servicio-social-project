<?php

namespace App\Rules;

use ConsoleTVs\Profanity\Facades\Profanity;
use Illuminate\Contracts\Validation\InvokableRule;

class NotBadWord implements InvokableRule
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
        if (!empty(Profanity::blocker($value)->badWords())) {
            $fail(__('The :attribute is offensive'));
        }
    }
}
