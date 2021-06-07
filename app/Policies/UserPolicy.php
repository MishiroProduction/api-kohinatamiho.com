<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\AdminUser;

class UserPolicy
{
    /**
     * Determine if the current user can create user
     *
     * @return bool
     */
    public function create(AdminUser $user): bool
    {
      
        if (me('role') == AdminUser::ROLE_SYSTEM || me('role') == AdminUser::ROLE_ADMIN) {
            return true;
        }
        return false;
    }

    /**
     * Determine if the current user can update user
     *
     * @return bool
     */
    public function update(AdminUser $user, AdminUser $editUser): bool
    {
      
        if (me('role') == AdminUser::ROLE_SYSTEM || me('role') == AdminUser::ROLE_ADMIN) {
            return true;
        }
        return false;
    }
}
