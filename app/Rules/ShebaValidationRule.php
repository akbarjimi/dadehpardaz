<?php

namespace App\Rules;

use App\Enum\Banks;
use Illuminate\Contracts\Validation\Rule;

class ShebaValidationRule implements Rule
{
    public function passes($attribute, $value)
    {
        $digits = \substr(string: $value, offset: 0, length: 2);

        $banks = [Banks::MELLAT,Banks::MELLI, Banks::PASARGAD,];
        foreach ($banks as $format) {
            if ($digits === $format) {
                return true;
            }
        }

        return false;
    }

    public function message()
    {
        return 'این بانک پشتیبانی نمی شود.';
    }
}
