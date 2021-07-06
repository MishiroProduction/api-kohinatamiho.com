<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Models\User;
use App\Http\Requests\Request as AppRequest;

class CreateUserRequest extends AppRequest
{
    /**
     * Determine if the user is authorizpassword_confirmed to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return me() && me()->can('create', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'mail_address' => 'required|string|email:rfc',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
            'user_name' => 'required|string',
            'status' => 'required|boolean',
            'role' => 'required|int',
        ];
    }


    /**
     * messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'mail_address.required' => 'メールアドレスは必須です',
            'password.required' => 'パスワードは必須です',
            'password.min' => 'パスワードは8文字以上の文字列を入力してください',
            'password_confirm.required' => 'パスワード(確認)は必須です',
            'name.required' => '名前は必須です',
            'role.required' => 'ロールは必須です',
            'status.required' => 'ステータスは必須です',
            'password_confirm.same' => 'パスワードが一致しません',
        ];
    }

    public function attributes(): array
    {
        return [
            'mail_address' => 'メールアドレス',
            'password' => 'パスワード',
            'password_confirm' => 'パスワード(確認)',
            'name' => '名前',
            'role' => 'ロール',
            'status' => 'ステータス',
        ];
    }
}
