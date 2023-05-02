<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CreditCardExpirationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(\Carbon\Carbon::parse($value)->diffInMonths(now()) < 2){
            $fail('Expiration date must be atleast 2 months in the future');
        }
    }
}
