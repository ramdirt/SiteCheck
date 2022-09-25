<?php

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    protected $model = Site::class;

    public function definition()
    {
        return [
            'name' => 'site_' . rand(1, 100000),
            'url' => 'site' . rand(1, 100000) . '.ru',
            'status' => false
        ];
    }
}