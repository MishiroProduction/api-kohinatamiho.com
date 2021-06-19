<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createValidUserAccount(): User
    {
        $params = [
            'mail_address' => genRandStr(200) . '@test.test',
            'password' => 'password',
            'user_name' => 'user_name',
            'status' => rand(true, false),
            'role' => rand(0, 2),
        ];

        return User::create($params);
    }
}
