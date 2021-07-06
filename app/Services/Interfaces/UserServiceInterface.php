<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Http\Requests\Users\IndexUserRequest;
use App\Http\Requests\Users\LoginUserRequest;
use App\Http\Requests\Users\CreateUserRequest;

interface UserServiceInterface
{
    public function index(IndexUserRequest $request): array;
    public function login(LoginUserRequest $request): array;
    public function create(CreateUserRequest $request): array;
}
