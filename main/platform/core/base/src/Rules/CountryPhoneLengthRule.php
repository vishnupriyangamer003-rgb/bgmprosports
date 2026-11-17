<?php

namespace Botble\Base\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Validates the national number length for countries with a fixed numbering plan
 * (US/Canada +1 and India +91 = exactly 10 digits). Other countries are not restricted here.
 */
class CountryPhoneLengthRule implements ValidationRule
{
    protected const FIXED_LENGTH = ['1' => 10, '91' => 10];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || ! str_starts_with($value, '+')) {
            return;
        }

        $digits = preg_replace('/\D/', '', $value);

        foreach (self::FIXED_LENGTH as $code => $length) {
            if (str_starts_with($digits, (string) $code)) {
                if (strlen($digits) - strlen((string) $code) !== $length) {
                    $fail(__('Please enter a valid :length-digit phone number for the selected country (+:code).', [
                        'length' => $length,
                        'code' => $code,
                    ]));
                }

                return;
            }
        }
    }
}
