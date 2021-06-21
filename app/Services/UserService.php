<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\UserServiceInterface;
use App\Models\User;
use App\Services\Service as AppService;
use App\Http\Requests\Users\IndexUserRequest;
use App\Http\Requests\Users\LoginUserRequest;

class UserService extends AppService implements UserServiceInterface
{
    /**
     * Get User list
     *
     * @param IndexUserRequest $request
     * @return array
     */
    public function index(IndexUserRequest $request): array
    {
        $orderBy = $request->input('order_by', 'id');
        $sortOrder = $request->input('sort', 'asc');
        if ($request->has('page')) {
            $perPage = $request->input('per_page', 10);
            $users = User::select('*')
                ->sortSetting($orderBy, $sortOrder)
                ->paginate($perPage);
        } else {
            $users = User::select('*')
                ->sortSetting($orderBy, $sortOrder)
                ->get();


        }
        return [
            'status' => true,
            'data' => $users,
        ];
    }

    /**
     * login
     *
     * @param LoginUserRequest $request
     * @return array
     */
    public function login(LoginUserRequest $request): array
    {
        $params = $request->only('mail_address', 'password');

        $user = User::where(['mail_address' => $params])->first();
        if (empty($user)) {
            return [
                'status' => false,
                'errors' => [
                    'key' => '404Notfound',
                ]
            ];
        }

        $credentials = [
            'mail_address' => $params['mail_address'],
            'password' => $params['password'],
            'status' => true,
        ];
        if (!Auth::guard('api')->attempt($credentials)) {
            return [
                'status' => false,
                'errors' => [
                    'key' => 'login_failure',
                ],
            ];
        }

        $user = Auth::guard('api')->user();
        $accessToken = auth('api')->claims([
            'guard' => 'api'
        ])->attempt($credentials);

        return [
            'status' => true,
            'data' => [
                'user' => $user,
                'access_token' => $accessToken,
            ],
        ];
    }
}
