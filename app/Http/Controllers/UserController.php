<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as AppController;
use App\Services\Interfaces\UserServiceInterface;
use App\Http\Requests\Users\IndexUserRequest;
use App\Http\Requests\Users\LoginUserRequest;

class UserController extends AppController
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get User List
     *
     * @param IndexUserRequest $request
     * @return mixed
     */
    public function index(IndexUserRequest $request)
    {
        $response = $this->userService->index($request);
        if (!$response['status']) {
            if (!empty($response['errors'])) {
                $error = apiErrorResponse($response['errors']['key']);
                return response()->json($error['body'], $error['response_code']);
            }
            $error = apiErrorResponse('internal_server_error');
            return response()->json($error['body'], $error['response_code']);
        }
        return response()->json([
            'status' => true,
            'errors' => null,
            'message' => '',
            'data' => $response['data'],
        ], 200);
    }

    /**
     * Login
     *
     * @param LoginUserRequest $request
     * @return mixed
     */
    public function login(LoginUserRequest $request)
    {
        $response = $this->userService->login($request);
        if (!$response['status']) {
            if (!empty($response['errors'])) {
                $error = apiErrorResponse($response['errors']['key']);
                return response()->json($error['body'], $error['response_code']);
            }
            $error = apiErrorResponse('internal_server_error');
            return response()->json($error['body'], $error['response_code']);
        }
        return response()->json([
            'status' => true,
            'errors' => null,
            'message' => '',
            'data' => $response['data'],
        ], 200);
    }
}
