<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;


class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_not_get_products()
    {
        $response = $this->get('/products');
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
    }

    public function test_user_can_get_products()
    {
        $response = $this->actingAs($this->superAdmin)->get('/products');
        $response->assertStatus(200);
        $response->assertViewHas('products');
    }

    public function test_user_can_delete_products()
    {
        $product = Product::firstOrCreate(['name' => 'ProductTest', 'price' => 25, 'format' => '1 unidad']);
        $response = $this->actingAs($this->superAdmin)->delete(route('products.destroy', $product));
        $response->assertStatus(302);
        $response->assertRedirectToRoute('products.index');
    }

    public function test_user_can_create_products()
    {
        $response = $this->actingAs($this->superAdmin)->post(
            route('products.store'),
            ['name' => 'ProductTest', 'price' => 25, 'format' => '1 unidad']
        );
        $response->assertStatus(302);
        $response->assertRedirectToRoute('products.index');
    }

    public function test_user_can_update_products()
    {
        $product = Product::first();
        $response = $this->actingAs($this->superAdmin)->put(
            route('products.update', $product),
            ['name' => 'ProductTest', 'price' => 25, 'format' => '1 unidad']
        );
        $response->assertStatus(302);
        $response->assertRedirectToRoute('products.index');
    }

    public function test_user_can_asign_product()
    {
        $product = Product::first();
        $response = $this->actingAs($this->superAdmin)->post(route('products.asignProduct', $product));
        $response->assertStatus(302);
        $response->assertRedirectToRoute('products.index');
    }

    public function test_asign_product_with_not_numeric_amount()
    {
        $product = Product::first();
        $response = $this->actingAs($this->superAdmin)->post(route('products.asignProduct', $product), ['amount' => 'no numeric value']);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('products.index');
    }
}
