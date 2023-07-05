<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EndWithQuestionMarkRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (substr($value, -1) != '?') {
            $fail(__(
                "Are you sure that is a question? It's missing the question mark in the end at attribute :attribute",
                [
                    'attribute' => $attribute
                ]
            ));
        }
    }
}
