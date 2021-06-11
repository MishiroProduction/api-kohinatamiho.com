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
    public function index(IndexUserRequest $request): array
    {
        $orderBy = $request->input('order_by', 'id');
        $sortOrder = $request->input('sort', 'asc');
        if ($request->has('page')) {
            $perPage = $request->input('per_page', 10);
            $members = User::select('*')
                ->sortSetting($orderBy, $sortOrder)
                ->paginate($perPage);
        } else {
            $members = User::select('*')
                ->sortSetting($orderBy, $sortOrder)
                ->get();
        }
        return [
            'status' => true,
            'errors' => null,
            'message' => '',
            'data' => $members,
        ];
    }

    public function login(LoginUserRequest $request): array
    {
        $credentials = $request->only('mail_address', 'password');
        $credentials += [
            'status' => true,
        ];
        if (!Auth::guard('user')->attempt($credentials)) {
            return [
                'status' => false,
                'errors' => [
                    'key' => 'unauthorized',
                ],
            ];
        }

        $user = Auth::guard('user')->user();
        $accessToken = auth('user')->claims([
            'guard' => 'user'
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
