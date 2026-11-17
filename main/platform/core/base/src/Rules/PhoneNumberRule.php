<?php

namespace Botble\Base\Rules;

use Botble\Base\Facades\BaseHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumberRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail(trans('validation.string'));

            return;
        }

        $rules = BaseHelper::getPhoneValidationRule(asArray: true);

        $min = str($rules[0])->replace('min:', '')->toInteger();
        $max = str($rules[1])->replace('max:', '')->toInteger();
        $regex = str($rules[2])->replace('regex:', '');

        $length = mb_strlen($value);

        if ($length < $min) {
            $fail(trans('validation.min.string', ['min' => $min]));

            return;
        }

        if ($length > $max) {
            $fail(trans('validation.max.string', ['max' => $max]));

            return;
        }

        if (! preg_match($regex, $value)) {
            $fail(trans('validation.regex'));
        }
    }
    /**
     * National (significant) number length [min, max] per calling code.
     * Unlisted calling codes fall back to 6-12 digits.
     */
    protected static array $nationalLengths = [
        '1' => [10, 10], '7' => [10, 10], '20' => [9, 10], '27' => [9, 9], '30' => [10, 10], '31' => [9, 9],
        '32' => [8, 9], '33' => [9, 9], '34' => [9, 9], '36' => [8, 9], '39' => [6, 11], '40' => [9, 9],
        '41' => [9, 9], '43' => [10, 13], '44' => [10, 10], '45' => [8, 8], '46' => [7, 10], '47' => [8, 8],
        '48' => [9, 9], '49' => [10, 11], '51' => [9, 9], '52' => [10, 10], '53' => [8, 8], '54' => [10, 11],
        '55' => [10, 11], '56' => [9, 9], '57' => [10, 10], '58' => [10, 10], '60' => [9, 10], '61' => [9, 9],
        '62' => [8, 12], '63' => [10, 10], '64' => [8, 10], '65' => [8, 8], '66' => [9, 9], '81' => [9, 10],
        '82' => [9, 10], '84' => [9, 10], '86' => [11, 11], '90' => [10, 10], '91' => [10, 10], '92' => [10, 10],
        '93' => [9, 9], '94' => [9, 9], '95' => [8, 10], '98' => [10, 10], '212' => [9, 9], '213' => [9, 9],
        '216' => [8, 8], '218' => [9, 10], '233' => [9, 9], '234' => [8, 10], '251' => [9, 9], '254' => [9, 9],
        '255' => [9, 9], '256' => [9, 9], '351' => [9, 9], '352' => [8, 9], '353' => [8, 9], '358' => [8, 10],
        '380' => [9, 9], '420' => [9, 9], '880' => [10, 10], '960' => [7, 7], '961' => [7, 8], '962' => [9, 9],
        '963' => [9, 9], '964' => [10, 10], '965' => [8, 8], '966' => [9, 9], '967' => [9, 9], '968' => [8, 8],
        '970' => [9, 9], '971' => [9, 9], '972' => [9, 9], '973' => [8, 8], '974' => [8, 8], '975' => [8, 8],
        '976' => [8, 8], '977' => [10, 10], '992' => [9, 9], '993' => [8, 8], '994' => [9, 9], '995' => [9, 9],
        '996' => [9, 9], '998' => [9, 9],
    ];

    /**
     * Closure rule: the national number must have the right length for the selected country code.
     */
    public static function countryLength(): Closure
    {
        return function (string $attribute, mixed $value, Closure $fail): void {
            if (! is_string($value) || ! str_starts_with($value, '+')) {
                return;
            }

            $digits = preg_replace('/\D/', '', $value);

            foreach ([1, 2, 3] as $len) {
                $code = substr($digits, 0, $len);

                if (! isset(self::$nationalLengths[$code])) {
                    continue;
                }

                [$min, $max] = self::$nationalLengths[$code];
                $national = strlen($digits) - $len;

                if ($national < $min || $national > $max) {
                    $fail(__('Please enter a valid :length-digit phone number for the selected country (+:code).', [
                        'length' => $min === $max ? $min : "$min-$max",
                        'code' => $code,
                    ]));
                }

                return;
            }

            $national = strlen($digits) - 2;

            if ($national < 6 || $national > 12) {
                $fail(__('Please enter a valid phone number for the selected country.'));
            }
        };
    }
}
