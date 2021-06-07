<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the current user can create news
     *
     * @return bool
     */
    public function create(): bool
    {
      
        if (me('role') == AdminUser::ROLE_SYSTEM || me('role') == AdminUser::ROLE_ADMIN) {
            return true;
        }
        return false;
    }

    /**
     * Determine if the current user can update news
     *
     * @return bool
     */
    public function update(): bool
    {
      
        if (me('role') == AdminUser::ROLE_SYSTEM || me('role') == AdminUser::ROLE_ADMIN) {
            return true;
        }
        return false;
    }
}
