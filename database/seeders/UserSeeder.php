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
            'email' => 'ramdirt@mail.ru',
            'password' => bcrypt('admin'),
            'wallet' => 10000,
            'interval' => 1,
            'is_admin' => true,
            'telegram_id' => 1053678973,
            'api_token' => Str::random(60)
        ]);
    }
}