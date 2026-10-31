<?php

namespace App\Rules;

use Closure;
use DateTime;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class FullYear implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $date = DateTime::createFromFormat('!Y', $value);
        $errors = DateTime::getLastErrors();

        if (
            !$date ||
            ($errors !== false && ($errors['warning_count'] > 0 || $errors['error_count'] > 0))
        ) {
            $fail('The :attribute must be a valid date year.');
        }
    }
}
