<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ListingsTest extends TestCase {

    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_listings_page_returns_a_successful_response() {

        $listing = Listing::factory()->create();
        $listing->save();

        $response = $this->get('/listings');

        $response->assertOk();
    }

    public function test_listings_details_page_returns_a_successful_response() {

        $listing = Listing::factory()->create();
        $listing->save();

        $response = $this->get('/listing/details/' . $listing->id);

        $response->assertOk();
    }
}
