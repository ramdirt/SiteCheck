<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'telegram_id' => 1053678973,
            'api_token' => Str::random(60)
        ]);
        DB::table('users')->insert([
            'name' => 'Алексей',
            'email' => 'ramdirt@mail.ru',
            'interval' => 5,
            'wallet' => 100,
            'is_admin' => true,
            'password' => bcrypt('ramdirt'),
            'telegram_id' => 1053678973,
            'api_token' => Str::random(60)
        ]);
    }
}