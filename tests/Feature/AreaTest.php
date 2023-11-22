<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Area;

class AreaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_not_get_areas()
    {
        $response = $this->get('/areas');
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
    }

    public function test_user_can_get_areas()
    {
        $response = $this->actingAs($this->superAdmin)->get('/areas');
        $response->assertStatus(200);
        $response->assertViewHas('areas');
    }

    public function test_user_can_delete_areas()
    {
        $area = Area::first();
        $response = $this->actingAs($this->superAdmin)->delete(route('areas.destroy', $area));
        $response->assertStatus(302);
        $response->assertRedirectToRoute('areas.index');
    }

    public function test_user_can_create_areas()
    {
        $response = $this->actingAs($this->superAdmin)->post(route('areas.store'), 
        ['name' => 'AreaTestCreate','workers_count' => 25]
    );
        $response->assertStatus(302);
        $response->assertRedirectToRoute('areas.index');
    }

    public function test_user_can_update_areas()
    {
        $area = Area::first();
        $response = $this->actingAs($this->superAdmin)->put(route('areas.update' , $area), 
        ['name' => 'AreaTestUpdate','workers_count' => 24]
    );
        $response->assertStatus(302);
        $response->assertRedirectToRoute('areas.index');
    }
}
