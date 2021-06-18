<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Http\Requests\Users\IndexUserRequest;
use App\Http\Requests\Users\LoginUserRequest;

interface UserServiceInterface
{
    public function index(IndexUserRequest $request): array;
    public function login(LoginUserRequest $request): array;
}
