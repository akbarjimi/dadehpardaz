<?php

namespace App\Providers;

use App\Events\RequestPaidEvent;
use App\Events\RequestRejectedEvent;
use App\Listeners\RequestPaidListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\RequestRejectedListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        RequestRejectedEvent::class => [
            RequestRejectedListener::class,
        ],
        RequestPaidEvent::class => [
            RequestPaidListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
