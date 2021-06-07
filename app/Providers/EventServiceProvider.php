<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        if ($this->app->environment("local")) {
            \DB::listen(
                function ($query) {
                    \Log::info($query->sql . PHP_EOL);
                    \Log::info(json_encode($query->bindings) . PHP_EOL);
                    \Log::info("time(ms):{$query->time}" . PHP_EOL);
                }
            );
        }
    }
}
