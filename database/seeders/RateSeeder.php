<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rates')->insert([
            'name' => 'default',
            'price' => 0.05,
        ]);
        DB::table('rates')->insert([
            'name' => 'vip',
            'price' => 0.1,
        ]);
    }
}