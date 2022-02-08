<?php

namespace App\Gateways;

class Behpardakht implements DriverInterface
{
    public function __construct()
    {
    }

    public function transfer(string $source, string $destination, int $amount)
    {
        // Redirect to gateway
    }

    public function verify()
    {

    }
}
