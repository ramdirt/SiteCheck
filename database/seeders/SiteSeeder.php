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
        User::find(1)->sites()->create([
            'name' => 'Вконтакте',
            'url' => 'vk.com',
            'last_check' => Carbon::now()->subMinutes(30),
            'status' => true
        ]);
        User::find(3)->sites()->create([
            'name' => 'Одноклассники',
            'url' => 'ok.ru',
            'last_check' => Carbon::now()->subMinutes(30),
            'status' => false
        ]);

        User::find(3)->sites()->create([
            'name' => 'Ютуб',
            'url' => 'youtube.com',
            'last_check' => Carbon::now()->subMinutes(30),
            'status' => false
        ]);
    }
}
