<?php

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_categories()
    {
        Category::factory()->count(10)->create();

        $response = $this->get('/api/categories');

        $response->assertStatus(200);
        $response->assertJsonCount(10);
    }

    public function test_sections()
    {
        $response = $this->get('/api/sections');
        $response->assertStatus(503);
    }
}