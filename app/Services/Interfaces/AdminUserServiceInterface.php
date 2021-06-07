<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Models\AdminUser;
use App\Http\Requests\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface AdminUserServiceInterface
{
    public function getUsers(): LengthAwarePaginator;
    public function createUser(Request $request): AdminUser;
    public function updateUser(AdminUser $user, Request $request);
    public function deleteUser(AdminUser $user);
}
