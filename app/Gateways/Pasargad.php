<?php

namespace App\Gateways;

class Pasargad implements DriverInterface
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
