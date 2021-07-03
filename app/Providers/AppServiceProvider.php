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
        Interfaces\UserServiceInterface::class => Services\UserService::class,
        Interfaces\NewsServiceInterface::class => Services\NewsService::class,
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
        // Query Builder
        Builder::macro('whereLike', function (string $attribute, string $term, int $position = 0) {
            // $position =  0, mean search the partial, for example: %{term}%
            // $position =  1, mean search the beginning, for example: {term}%
            // $position = -1, mean search the ending, for example: %{term}

            $term = addcslashes($term, '\_%');

            $condition = [
                    1  => $term . '%',
                    -1 => '%' . $term,
                ][$position] ?? '%' . $term . '%';

            return $this->where($attribute, 'LIKE', $condition);
        });

        Builder::macro('orWhereLike', function (string $attribute, string $term, int $position = 0) {
            // $position =  0, mean search the partial, for example: %{term}%
            // $position =  1, mean search the beginning, for example: %{term}
            // $position = -1, mean search the ending, for example: {term}%

            $term = addcslashes($term, '\_%');

            $condition = [
                    1  => $term . '%',
                    -1 => '%' . $term,
                ][$position] ?? '%' . $term . '%';

            return $this->orWhere($attribute, 'LIKE', $condition);
        });
    }
}
