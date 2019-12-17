<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // 登録済みのユーザーは削除
      DB::table('users')->delete();

      User::create([
        'name' => 'ブログ管理者',
        'email' => 'blog@admin.com',
        'password' => Hash::make('password')
      ]);
    }
  }
