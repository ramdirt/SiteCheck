<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // for ($i = 1; $i <= 10; $i++) {
        //     User::factory()->has(Site::factory()->count(6)->state(new Sequence(
        //         fn ($sequence) => $this->getSiteArray($sequence->index)
        //     )))->create();
        // }

        $this->call([
            UserSeeder::class,
            SiteSeeder::class,
        ]);
    }

    public function getSiteArray($index)
    {
        $sites = collect([
            'Яндекс' => 'ya,ru',
            'Гугл' => 'google.ru',
            'МэйлРу' => 'mail.ru',
            'ЛентаРу' => 'lenta.ru',
            'Озон' => 'ozon.ru',
            'Дром' => 'drom.ru',
            'ХеадХантер' => 'hh.ru',
            'Пикубу' => 'pikabu.ru'
        ]);

        return [
            'name' => $sites->keys()[$index],
            'url' => $sites->get($sites->keys()[$index]),
        ];
    }
}