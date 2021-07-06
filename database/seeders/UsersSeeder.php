<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'mail_address' => 'takada_yuki@kohinatamiho.com',
            'password' => Hash::make('hogehoge'),
            'user_name' => '高田憂希',
            'status' => true,
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'mail_address' => 'matsui_eriko@kohinatamiho.com',
            'password' => Hash::make('hogehoge'),
            'user_name' => '松井恵理子',
            'status' => true,
            'role' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
