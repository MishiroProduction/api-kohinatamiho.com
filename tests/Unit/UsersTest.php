<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\Users\LoginUserRequest;
use App\Http\Requests\Users\IndexUserRequest;
use App\Http\Requests\Users\CreateUserRequest;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Index test
     */
    public function testIndex()
    {
        $service = new UserService();
        $indexRequest = new IndexUserRequest();

        /* Create user */
        $params = [
            'mail_address' => 'takata_yuki@test.test',
            'password' => Hash::make('takada_yuki'),
            'user_name' => '高田憂希',
            'status' => true,
            'role' => User::ROLE_SYSTEM,
        ];
        User::create($params);
        unset($params['password']);

        /* Pagination */
        $paginateParams = [
            'page' => 1,
        ];
        $indexRequest->merge($paginateParams);
        $paginateResponse = $service->index($indexRequest);
        foreach ($params as $key => $value) {
            $this->assertSame($paginateResponse['data'][0][$key], $params[$key]);
        }

        $indexRequest->replace([]);
        $response = $service->index($indexRequest);
        foreach ($params as $key => $value) {
            $this->assertSame($response['data'][0][$key], $params[$key]);
        }
    }

    /**
     * Login test
     */
    public function testLogin()
    {
        $service = new UserService();
        $request = new LoginUserRequest();

        /* Doesn't exist user login */
        $request->merge([
            'mail_address' => 'matsui_eriko@test.test',
            'password' => 'password',
        ]);
        $notExistUserResponse = $service->login($request);
        $notExistUserResponseType = [
            'status' => false,
            'errors' => [
                'key' => '404Notfound',
            ]
        ];
        $this->assertSame($notExistUserResponseType, $notExistUserResponse);

        /* Create user */
        $params = [
            'mail_address' => 'takata_yuki@test.test',
            'password' => Hash::make('takada_yuki'),
            'user_name' => '高田憂希',
            'status' => true,
            'role' => rand(1, 3),
        ];
        User::create($params);

        /* Password not same */
        $request->merge([
            'mail_address' => $params['mail_address'],
            'password' => 'password',
        ]);
        $loginFailureResponse = $service->login($request);
        $loginFailureResponseType = [
            'status' => false,
            'errors' => [
                'key' => 'login_failure',
            ],
        ];
        $this->assertSame($loginFailureResponseType, $loginFailureResponse);

        /* Success */
        $request->merge([
            'mail_address' => $params['mail_address'],
            'password' => 'takada_yuki',
        ]);
        $response = $service->login($request);
        $this->assertSame(true, $response['status']);
    }

    public function testCreate(): void
    {
        $service = new UserService();
        $createRequest = new CreateUserRequest();

        /* Create user */
        $params = [
            'mail_address' => 'takata_yuki@test.test',
            'password' => Hash::make('takada_yuki'),
            'user_name' => '高田憂希',
            'status' => true,
            'role' => User::ROLE_SYSTEM,
        ];
        User::create($params);
        unset($params['password']);

        $duplicateCreateParams = [
            'mail_address' => $params['mail_address'],
            'password' => 'hogehoge114514',
            'password_confirm' => 'hogehoge114514',
            'user_name' => $params['user_name'],
            'status' => $params['status'],
            'role' => $params['role'],
        ];

        $createRequest->replace($duplicateCreateParams);
        $duplicateResponse = $service->create($createRequest);
        $createDuplicateResponseType = [
            'status' => false,
            'errors' => [
                'key' => 'duplicate_entry',
            ],
        ];
        $this->assertSame($createDuplicateResponseType, $duplicateResponse);

        $params = [
            'mail_address' => 'matsui_eriko@test.test',
            'password' => 'hogehoge114514',
            'password_confirm' => 'hogehoge114514',
            'user_name' => '高田憂希',
            'status' => true,
            'role' => 1,
        ];
        $response = $createRequest->replace($params);
        $this->assertSame($response['status'], true);
    }
}
