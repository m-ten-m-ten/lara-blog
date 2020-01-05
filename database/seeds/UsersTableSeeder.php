<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 登録済みのユーザーは削除
        // User::truncate();ß

        User::create([
            'name'     => 'ブログ管理者',
            'email'    => 'blog@admin.com',
            'password' => Hash::make('password'),
        ]);
    }
}
