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
                    $route = 'no_url';
                    if (method_exists(\Request::route(), 'getName')) {
                        $route = \Request::route()->getName();
                    }
                    \Log::channel('sql')->info('[ROUTE]' . $route);
                    \Log::channel('sql')->info('[QUERY]' . $this->mergeSqlBindings($query->sql, $query->bindings) . PHP_EOL);
                    \Log::channel('sql')->info('[TIME]' . "time(ms):{$query->time}" . PHP_EOL);
                }
            );
        }
    }

    private function mergeSqlBindings($sql, $bindings)
    {
        foreach ($bindings as $binding) {
            if (is_string($binding)) {
                $binding = "'{$binding}'";
            } elseif (is_bool($binding)) {
                $binding = $binding ? '1' : '0';
            } elseif (is_int($binding)) {
                $binding = (string) $binding;
            } elseif ($binding === null) {
                $binding = 'NULL';
            } elseif ($binding instanceof Carbon) {
                $binding = "'{$binding->toDateTimeString()}'";
            } elseif ($binding instanceof DateTime) {
                $binding = "'{$binding->format('Y-m-d H:i:s')}'";
            }
            $sql = preg_replace('/\\?/', $binding, $sql, 1);
        }
        return $sql;
    }
}
