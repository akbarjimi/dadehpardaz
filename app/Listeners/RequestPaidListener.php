<?php

namespace App\Listeners;

use App\Events\RequestPaidEvent;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RequestPaidNotification;

class RequestPaidListener
{
    public function handle(RequestPaidEvent $event)
    {
        Notification::send($event->financialRequest->user, new RequestPaidNotification($event->financialRequest));
    }
}
