<?php

namespace App\Listeners;

use App\Events\RequestRejectedEvent;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RequestRejectedNotification;

class RequestRejectedListener
{
    public function handle(RequestRejectedEvent $event)
    {
        // Send notification
        Notification::send($event->financialRequest->user, new RequestRejectedNotification($event->financialRequest));
    }
}
