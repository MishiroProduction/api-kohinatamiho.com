<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use App\Services\Interfaces;
use App\Services;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        Interfaces\NewsServiceInterface::class => Services\NewsService::class,
        Interfaces\AdminUserServiceInterface::class => Services\AdminUserService::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->macros();
    }

    /**
     * Register macros which will be used in application
     */
    protected function macros()
    {
        Blueprint::macro('dateTimes', function ($precision = 0) {
            $this->dateTime('created_at', $precision)->nullable()->comment('作成日時');
            $this->dateTime('updated_at', $precision)->nullable()->comment('更新日時');
        });
    }
}
