<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class OfferTest extends TestCase
{

    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_my_listing_can_create_offer_returns_successful_response() {

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $listing = Listing::factory()->create();
        $listing->posted_by = $user1->id;
        $listing->sold_at = null;
        $listing->save();

        $response = $this->actingAs($user2)
                ->withSession(['banned' => false])
                ->post('/listing/' . $listing->id . '/offer', [
                        'amount' => $listing->price
        ]);

        $this->assertDatabaseHas('offers', [
                'listing_id' => $listing->id,
                'bidder_id' => $user2->id
                ]);

        $response->assertRedirect();
    }

    public function test_my_listing_cannot_create_offer_if_listing_already_sold() {

        $user = User::factory()->create();

        $listing = Listing::factory()->create();
        $listing->posted_by = $user->id;
        $listing->sold_at = Carbon::now();
        $listing->save();

        $response = $this->actingAs($user)
                ->withSession(['banned' => false])
                ->post('/listing/' . $listing->id . '/offer', [
                        'amount' => $listing->price
        ]);

        $this->assertDatabaseMissing('offers', [
                'listing_id' => $listing->id,
                ]);

        $response->assertRedirect();
    }


    public function test_my_listing_can_accept_offer_returns_successful_response() {

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $listing = Listing::factory()->create();
        $listing->posted_by = $user1->id;
        $listing->save();

        $offer = Offer::factory()->create();
        $offer->listing_id = $listing->id;
        $offer->bidder_id = $user2->id;
        $offer->save();

        $response = $this->actingAs($user1)
                ->withSession(['banned' => false])
                ->put('/realtor/offer/'. $offer->id . '/accept');

        $this->assertDatabaseHas('offers', [
                'listing_id' => $listing->id,
                'bidder_id' => $offer->bidder_id,
                ]);

        $this->assertDatabaseMissing('offers', [
                'listing_id' => $listing->id,
                'bidder_id' => $offer->bidder_id,
                'accepted_at' => null //Accepted at should not now be null
                ]);

        $this->assertDatabaseHas('listings', [
                'id' => $listing->id
                ]);

        $this->assertDatabaseMissing('listings', [
                'id' => $listing->id,
                'sold_at' => null //Sold at should not now be null
                ]);

        $response->assertRedirect();
    }
}
