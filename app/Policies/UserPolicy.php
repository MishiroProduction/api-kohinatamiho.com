<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine if the current user can create user
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        if ($user->role === User::ROLE_SYSTEM) {
            return true;
        }
        return false;
    }

    /**
     * Determine if the current user can update user
     *
     * @param User $user
     * @param User $editUser
     * @return bool
     */
    public function update(User $user, User $editUser): bool
    {
        if ($user->role === User::ROLE_SYSTEM) {
            return true;
        }
        return false;
    }

    /**
     * Determine if the current user can delete user
     *
     * @param User $user
     * @param User $deleteUser
     * @return bool
     */
    public function delete(User $user, User $deleteUser): bool
    {
        if (me('role') === User::ROLE_SYSTEM && $user->id !== $deleteUser->id) {
            return true;
        }
        return false;
    }
}
