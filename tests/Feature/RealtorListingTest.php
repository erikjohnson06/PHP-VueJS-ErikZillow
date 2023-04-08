<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class RealtorListingTest extends TestCase
{

    use RefreshDatabase;
    //use WithoutMiddleware;

    public function test_my_listings_page_redirects_if_unauthenticated() {

        $response = $this->get('/realtor/listing');

        $response->assertRedirect();
    }

    public function test_my_listings_page_returns_a_successful_response() {

        $user = User::factory()->create();
        $listing = Listing::factory()->create();
        $listing->posted_by = $user->id;
        $listing->save();

        $response = $this->actingAs($user)
                ->withSession(['banned' => false])
                ->get('/realtor/listing');

        $response->assertOk();
    }

    public function test_create_new_listing_page_returns_a_successful_response() {

        $user = User::factory()->create();

        $response = $this->actingAs($user)
                ->withSession(['banned' => false])
                ->get('/realtor/listing/create');

        $response->assertOk();
    }

    public function test_my_listing_detail_page_returns_a_successful_response() {

        $user = User::factory()->create();
        $listing = Listing::factory()->create();
        $listing->posted_by = $user->id;
        $listing->save();

        $response = $this->actingAs($user)
                ->withSession(['banned' => false])
                ->get('/realtor/listing/' . $listing->id);

        $response->assertOk();
    }

    public function test_my_listing_edit_page_returns_a_successful_response() {

        $user = User::factory()->create();
        $listing = Listing::factory()->create();
        $listing->posted_by = $user->id;
        $listing->save();

        $response = $this->actingAs($user)
                ->withSession(['banned' => false])
                ->get('/realtor/listing/' . $listing->id . '/edit');

        $response->assertOk();
    }

    public function test_my_listing_delete_page_redirects_after_response() {

        $user = User::factory()->create();
        $listing = Listing::factory()->create();
        $listing->posted_by = $user->id;
        $listing->save();

        $response = $this->actingAs($user)
                ->withSession(['banned' => false])
                ->delete('/realtor/listing/' . $listing->id);

        $response->assertRedirect();
    }

    public function test_my_listing_soft_delete_page_redirects_after_response() {

        $user = User::factory()->create();
        $listing = Listing::factory()->create();
        $listing->posted_by = $user->id;
        $listing->save();

        $response = $this->actingAs($user)
                ->withSession(['banned' => false])
                ->put('/realtor/listing/' . $listing->id . '/delete');

        $response->assertRedirect();
    }

    public function test_my_listing_restore_page_redirects_after_successful_response() {

        $user = User::factory()->create();
        $listing = Listing::factory()->create();
        $listing->posted_by = $user->id;
        $listing->save();

        $response = $this->actingAs($user)
                ->withSession(['banned' => false])
                ->put('/realtor/listing/' . $listing->id . '/restore');

        $response->assertRedirect();
    }
}
