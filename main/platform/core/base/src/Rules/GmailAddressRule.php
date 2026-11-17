<?php

namespace Botble\Base\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Rejects @gmail.com / @googlemail.com addresses that cannot exist
 * (Gmail local parts are 6-30 chars of letters, digits and periods).
 */
class GmailAddressRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || ! preg_match('/@(gmail|googlemail)\.com$/i', $value)) {
            return;
        }

        $local = substr($value, 0, (int) strrpos($value, '@'));

        if (! preg_match('/^[a-z0-9](?:[a-z0-9.]{4,28})[a-z0-9]$/i', $local) || str_contains($local, '..')) {
            $fail(__('Please enter a valid email address.'));
        }
    }
}
