<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon;

        DB::table('sites')->insert([
            'name' => 'Вконтакте',
            'url' => 'vk.com',
            'last_check' => $date->now(),
            'status' => true
        ]);

        DB::table('sites')->insert([
            'name' => 'Одноклассники',
            'url' => 'ok.ru',
            'last_check' => $date->now(),
            'status' => false
        ]);
    }
}