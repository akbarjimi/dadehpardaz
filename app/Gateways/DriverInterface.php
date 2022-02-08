<?php

namespace App\Gateways;

interface DriverInterface
{
    public function transfer(string $source, string $destination, int $amount);

    public function verify();
}
