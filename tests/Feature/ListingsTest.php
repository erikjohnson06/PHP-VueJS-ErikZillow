<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ListingsTest extends TestCase {

    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_listings_page_returns_a_successful_response() {

        $user = User::factory()->create();
        $listing = Listing::factory()->create();
        $listing->save();

        $response = $this->actingAs($user)
                ->withSession(['banned' => false])
                ->get('/listings');

        $response->assertStatus(200);

        $response->assertSee("Listings");

        $response->assertSee($listing->address); //Address should be visible on listings page
    }

    public function test_listings_details_page_returns_a_successful_response() {

        $user = User::factory()->create();
        $listing = Listing::factory()->create();
        $listing->save();

        $response = $this->actingAs($user)
                ->withSession(['banned' => false])
                ->get('/listing/details/' . $listing->id);

        $response->assertStatus(200);

        //$response->assertSee("Estimated Monthly Payment");

        $response->assertSee($listing->address); //Address should be visible on details page
    }

//    public function test_product_add_page_returns_a_successful_response() {
//
//        $user = User::factory()->create();
//        $response = $this->actingAs($user)
//                ->withSession(['banned' => false])
//                ->get('/product/add');
//
//        $response->assertStatus(200);
//
//        $response->assertSee("Add Product");
//    }
//
//    public function test_product_add_page_creates_new_product() {
//
//        $user = User::factory()->create();
//        $product = Product::factory()->create();
//
//        $response = $this->actingAs($user)
//                ->withSession(['banned' => false])
//                ->post('/product/store', [
//            'name' => "New " . $product->name,
//            'supplier_id' => $product->supplier_id,
//            'category_id' => $product->category_id,
//            'unit_id' => $product->unit_id,
//            'status_id' => $product->status_id
//        ]);
//
//        $this->assertDatabaseHas('products', [
//            'name' => "New " . $product->name,
//        ]);
//
//        $response->assertRedirect();
//    }
//
//    public function test_product_edit_page_returns_a_successful_response() {
//
//        $user = User::factory()->create();
//        $product = Product::factory()->create();
//
//        $response = $this->actingAs($user)
//                ->withSession(['banned' => false])
//                ->get('/product/edit/' . $product->id);
//
//        $response->assertStatus(200);
//
//        $response->assertSee("Edit Product");
//        $response->assertSee($product->name);
//    }
//
//    public function test_product_edit_page_can_update_product() {
//
//        $user = User::factory()->create();
//        $product = Product::factory()->create();
//
//        $response = $this->actingAs($user)
//                ->withSession(['banned' => false])
//                ->post('/product/update', [
//            'id' => (int) $product->id,
//            'name' => "Updated - " . $product->name,
//            'supplier_id' => $product->supplier_id,
//            'category_id' => $product->category_id,
//            'unit_id' => $product->unit_id,
//            'status_id' => $product->status_id
//        ]);
//
//        $this->assertDatabaseHas('products', [
//            'name' => "Updated - " . $product->name
//        ]);
//
//        $response->assertRedirect();
//    }
//
//    public function test_product_delete_request_returns_a_successful_response() {
//
//        $user = User::factory()->create();
//        $product = Product::factory()->create();
//
//        $response = $this->actingAs($user)
//                ->withSession(['banned' => false])
//                ->get('/product/delete/' . $product->id);
//
//        $this->assertDatabaseMissing('products', [
//            'id' => $product->id,
//        ]);
//
//        $response->assertRedirect();
//    }
}
