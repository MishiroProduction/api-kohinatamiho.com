<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\AdminUser;
use Closure;
use Illuminate\Support\Str;

class Accessible
{

    public function handle($request, Closure $next, $guard = null) {

        // Current user is not defined
        abort_unless(me(), 403);

        // Current route is not one of avaiable routes
        $accessibleRoutes = $this->getAccessibleRoutes(me('role'));
        abort_unless($this->containsCurrentRoute($accessibleRoutes), 403);

        return $next($request);
    }

    /**
     *
     *
     * @param int $roleId
     * @return array
     */
    protected function getAccessibleRoutes(int $roleId): array {

        $routes = [
            AdminUser::ROLE_SYSTEM => [
                'auth.*',
                'admin_users.*',
                'news.*',
                'top_page',
            ],
            AdminUser::ROLE_ADMIN => [
                'auth.*',
                'news.*',
                'top_page',
            ],
            AdminUser::ROLE_USER => [
                'auth.*',
                'news.index',
                'top_page',
            ]
        ];

        return data_get($routes, $roleId, []);

    }

    /**
     *
     *
     * @param array $avaiableRoutes
     * @return bool
     */
    protected function containsCurrentRoute(array $avaiableRoutes): bool {

        $currentRoute = \Route::currentRouteName();

        foreach ($avaiableRoutes as $route) {
            if (Str::is($route, $currentRoute)) {
                return true;
            }
        }

        return false;
    }
    
}
