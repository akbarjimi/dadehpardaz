<?php

namespace App\Channels;

use SMS;
use App\Models\User;
use Throwable;
use Whoops\Exception\ErrorException;
use Illuminate\Notifications\Notification;

class SMSChannel
{

    public function send(User $user, Notification $notification)
    {
        $mobile = $user->mobile;
        $verification_code = $this->getData($user, $notification);

        try {
            retry(3, function () use ($verification_code, $mobile) {
                // return SMS::sendVerification($verification_code, $mobile);
            }, 1);
        } catch (Throwable $throwable) {
            report($throwable);
            throw $throwable;
        }
    }

    protected function getData($notifiable, Notification $notification)
    {
        if (method_exists($notification, 'toSMS')) {
            return $notification->toSMS($notifiable);
        }

        throw new ErrorException(get_class($notification).'is missing toSMS method.');
    }
}
