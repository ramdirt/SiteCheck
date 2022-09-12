<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_sites_index_not_user_authenticated()
    {
        $response = $this->get('/sites');

        $response->assertStatus(302);
    }

    public function test_sites_index_user_authenticated()
    {
        $user = User::factory()->create([
            'id' => 10,
            'name' => 'name'
        ]);

        $response = $this->actingAs($user)->withSession(['banned' => false])->get('/sites');

        $response->assertStatus(200);
    }
}