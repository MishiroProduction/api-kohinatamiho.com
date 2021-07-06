<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createValidUserAccount(): User
    {
        $params = [
            'mail_address' => genRandStr(100) . '@test.test',
            'password' => Hash::make('password'),
            'user_name' => 'user_name',
            'status' => true,
            'role' => User::ROLE_SYSTEM,
        ];

        return User::create($params);
    }
}
