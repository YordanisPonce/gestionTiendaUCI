<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AsigmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_search_asigments()
    {
        $response = $this->get('//area-products?q=Jabon');
        $response->assertStatus(302);
        $response->assertRedirectToRoute('areas.area-products');
    }
}
