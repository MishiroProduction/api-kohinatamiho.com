<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\Users\LoginUserRequest;
use App\Http\Requests\Users\IndexUserRequest;

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
            'role' => rand(0, 2),
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
            'role' => rand(0, 2),
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
}
