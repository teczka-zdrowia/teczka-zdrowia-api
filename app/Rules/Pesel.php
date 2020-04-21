<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Pesel implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->validate($value);
    }

    /**
     * Determine if passed PESEL is valid.
     *
     * @param  string  $pesel
     * @return bool
     */
    public function validate($pesel)
    {
        $sum = 0;
        $weights = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3, 1];

        foreach (str_split($pesel) as $position => $digit) {
            $sum += $digit * $weights[$position];
        }

        return substr($sum % 10, -1, 1) == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'PESEL jest niepoprawny';
    }
}
