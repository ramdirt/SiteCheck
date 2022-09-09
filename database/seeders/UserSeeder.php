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
            'wallet' => 100,
            'interval' => 5,
            'is_admin' => true,
            'telegram_id' => 1053678973
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@user.com',
            'interval' => 15,
            'wallet' => 100,
            'password' => bcrypt('user'),
        ]);
        DB::table('users')->insert([
            'name' => 'Алексей',
            'email' => 'ramdirt@mail.ru',
            'interval' => 5,
            'wallet' => 100,
            'is_admin' => true,
            'password' => bcrypt('ramdirt'),
            'telegram_id' => 1053678973
        ]);
    }
}