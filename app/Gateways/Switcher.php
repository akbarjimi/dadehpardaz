<?php

namespace App\Gateways;

use App\Enum\Banks;
use LogicException;

class Switcher
{
    public static function gateway(string $sheba): DriverInterface
    {
        $digits = \substr(string: $sheba, offset: 0, length: 2);

        $gateways = [
            Banks::MELLI => Sadad::class,
            Banks::MELLAT => Behpardakht::class,
            Banks::PASARGAD => Pasargad::class,
        ];

        foreach ($gateways as $format => $gateway) {
            if ($digits == $format) {
                return new $gateway;
            }
        }

        throw new LogicException("No valid gateway");
    }
}
