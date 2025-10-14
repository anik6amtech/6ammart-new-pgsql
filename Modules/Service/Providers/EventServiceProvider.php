<?php

namespace Modules\Service\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Modules\Service\Events\BookingRequested;
use Modules\Service\Listeners\SendBookingRequestEmail;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    public function boot()
    {
        Event::listen(
            BookingRequested::class,
            [SendBookingRequestEmail::class, 'handle']
        );
    }
}
