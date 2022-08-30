<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
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

        User::find(1)->sites()->create([
            'name' => 'Вконтакте',
            'url' => 'vk.com',
            'last_check' => $date->now()->subMinutes(30),
            'status' => true
        ]);

        User::find(1)->sites()->create([
            'name' => 'Одноклассники',
            'url' => 'ok.ru',
            'last_check' => $date->now()->subMinutes(30),
            'status' => false
        ]);
        User::find(1)->sites()->create([
            'name' => 'Ютуб',
            'url' => 'youtube.com',
            'last_check' => $date->now()->subMinutes(30),
            'status' => false
        ]);
        User::find(1)->sites()->create([
            'name' => 'Авиа белеты',
            'url' => 'travel.yandex.ru/avia/',
            'last_check' => $date->now()->subMinutes(30),
            'status' => false
        ]);
    }
}
