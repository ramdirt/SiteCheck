<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Site;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::find(1)->pages()->create([
            'name' => 'Прайслист',
            'path' => 'pricelist',
        ]);
    }
}