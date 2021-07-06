<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\Users\CreateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            'status' => User::STATUS_VALID,
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

    /**
     * User create
     *
     * @param CreateUserRequest $request
     * @return array
     */
    public function create(CreateUserRequest $request): array
    {
        $params = $request->only('mail_address', 'password', 'user_name', 'status', 'role');

        /* 1.メールアドレス重複チェック */
        $user = User::where(['mail_address' => $params])->where('status', '!=', User::STATUS_INVALID)->first();
        if (!empty($user)) {
            return [
                'status' => false,
                'errors' => [
                    'key' => 'duplicate_entry',
                ]
            ];
        }

        /* 2.トランザクション開始 */
        DB::beginTransaction();
        try {
            $insertData = [
                'mail_address' => $params['mail_address'],
                'password' => Hash::make($params['password']),
                'user_name' => $params['user_name'],
                'status' => $params['status'],
                'role' => $params['role'],
            ];

            /* 3.ユーザー情報登録 */
            $user = User::create($insertData);

            /* 4.コミット */
            DB::commit();
            return [
                'status' => true,
                'data' => [
                    'id' => $user['id'],
                    'mail_address' => $user['mail_address'],
                    'user_name' => $user['user_name'],
                    'status' => $user['status'],
                    'role' => $user['role'],
                    'created_at' => $user['created_at'],
                    'updated_at' => $user['updated_at'],
                ],
            ];
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            DB::rollBack();
            return [
                'status' => false,
                'errors' => [
                    'key' => 'internal_server_error',
                ],
            ];
        }
    }
}
