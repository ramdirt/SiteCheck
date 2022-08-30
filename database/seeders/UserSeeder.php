<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'interval' => 5,
            'is_admin' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@user.com',
            'interval' => 15,
            'password' => bcrypt('user'),
        ]);
        DB::table('users')->insert([
            'name' => 'Алексей',
            'email' => 'ramdirt@mail.ru',
            'interval' => 5,
            'password' => bcrypt('ramdirt'),
            'telegram_id' => 1053678973
        ]);
    }
}