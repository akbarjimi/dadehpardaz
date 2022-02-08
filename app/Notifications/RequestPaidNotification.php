<?php

namespace App\Notifications;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestPaidNotification extends Notification
{
    use Queueable;

    public function __construct(public Request $financialRequest)
    {
    }

    public function via($notifiable)
    {
        // return ['mail', SMSChannel::class];
    }

    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line($this->financialRequest->user->name)
        //             ->line('Your request has been rejected!');
    }

    public function toSMS()
    {
        // return [
        //     'parameters' => [
        //         'user' => $this->financialRequest->user->name,
        //     ],
        //     'template_id' => '<template id>',
        //     'number' => $this->financialRequest->user->mobile,
        // ];
    }
}
