<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Http\Requests\Request as AppRequest;

class LoginUserRequest extends AppRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mail_address' => 'required|string|email:rfc',
            'password' => 'required|string|min:8',
        ];
    }
}
