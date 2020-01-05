<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(PostTagTableSeeder::class);
    }
}
