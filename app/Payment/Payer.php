<?php

namespace App\Payment;

use Throwable;
use App\Models\Request;

class Payer
{
    public function __construct()
    {
        //
    }

    public function clear()
    {
        try {
            Request::whereNotNull('approved_at')
                ->whereNull('rejected_at')
                ->whereNull('paid_at')
                ->cursor()
                ->each(fn (Request $request) => $request->pay());
        } catch (Throwable $e) {
            report($e);
        }
    }
}
