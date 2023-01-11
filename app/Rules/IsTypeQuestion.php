<?php

namespace App\Rules;

use App\Enums\TypesQuestion;
use App\Models\Question;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Support\Facades\Validator;

class IsTypeQuestion implements ValidatorAwareRule, InvokableRule
{
    /**
     * The validator instance.
     *
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;

    /**
     * Set the current validator.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return $this
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $type = Question::find($value['questionId'])->field->type;
        switch ($type) {
            case TypesQuestion::STRING->value:
                self::validateType($value, ['sometimes', 'present', 'nullable', 'string'], $fail);
                break;
            case TypesQuestion::INT->value:
                self::validateType($value, ['sometimes', 'present', 'nullable', 'integer', 'numeric'], $fail);
                break;
            case TypesQuestion::FLOAT->value:
                self::validateType($value, ['sometimes', 'present', 'nullable', 'regex:/^\d+(\.\d{1,2})?$/'], $fail);
                break;
            case TypesQuestion::BOOLEAN->value:
                self::validateType($value, ['sometimes', 'present', new Boolean, 'nullable'], $fail);
                break;
            case TypesQuestion::DATETIME->value:
                self::validateType($value, ['sometimes', 'present', 'nullable', 'date', 'date_format:Y-m-d'], $fail);
                break;
            case TypesQuestion::TIME->value:
                self::validateType($value, ['sometimes', 'present', 'nullable', 'date_format:H:i:s'], $fail);
                break;
            case TypesQuestion::MULTIPLE->value:
                self::validateType($value, ['sometimes', 'present', 'nullable', 'string'], $fail);
                break;
            case TypesQuestion::SELECT->value:
                self::validateType($value, ['sometimes', 'present', 'nullable', 'string'], $fail);
                break;
            case TypesQuestion::FILE->value:
                self::validateType($value, ['sometimes', 'present', 'nullable', 'string'], $fail);
                break;
        }
    }

    private function validateType($value, array $rules, $fail)
    {
        $validator = Validator::make($value, [
            'answer' => $rules,
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $fail($errors->first('answer'));
        }
    }

}
