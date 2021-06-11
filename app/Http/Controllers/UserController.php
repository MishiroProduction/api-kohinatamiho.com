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

    public function index(IndexUserRequest $request)
    {
        $response = $this->userService->index($request);
        if (!$response['status']) {
            return response()->json([], 404);
        }
        return response()->json($response['data'], 200);
    }

    public function login(LoginUserRequest $request)
    {
        $response = $this->userService->login($request);
        return response()->json($response['data'], 200);
    }
}
