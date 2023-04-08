<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class OfferTest extends DuskTestCase
{

    use DatabaseTruncation;

    /**
     * @group offer
     * @return void
     */
    public function test_offers_can_be_submitted_for_authenticated_users(): void
    {

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $listing = Listing::factory()->create();
        $listing->posted_by = $user1->id;
        $listing->sold_at = null;
        $listing->save();

        $this->browse(function (Browser $browser) use ($listing, $user2) {

            $browser->visit('/login')
                ->type('@email', $user2->email)
                ->type('@password', 'password')
                ->click('@login-button');

            $browser->waitForLocation("/listings")
                ->assertSee($user2->name);

            $browser->visit('/listing/details/' . $listing->id)
                    ->assertSee('Basic Info')
                    ->assertSee('Estimated Monthly Payment')
                    ->assertSee($listing->address)
                    ->assertSee('Make an Offer') //Option to make an offer should not be displayed
                    ->click('@make-an-offer');

            $browser->waitForText("Offer has been submitted")
                ->assertSee("Offer has been submitted");
        });
    }

    /**
     * @group offer
     * @return void
     */
    public function test_offers_can_be_accepted_for_authenticated_users(): void
    {

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $listing = Listing::factory()->create();
        $listing->posted_by = $user1->id;
        $listing->sold_at = null;
        $listing->save();

        $offer = Offer::factory()->create();
        $offer->listing_id = $listing->id;
        $offer->bidder_id = $user2->id;
        $offer->save();

        $this->browse(function (Browser $browser) use ($listing, $offer, $user1) {

            $browser->visit('/login')
                ->type('@email', $user1->email)
                ->type('@password', 'password')
                ->click('@login-button');

            $browser->waitForLocation("/listings")
                ->assertSee($user1->name);

            $browser->visit('realtor/listing/' . $listing->id)
                    ->assertSee('Offer #' . $offer->id)
                    ->assertSee($listing->address)
                    ->assertSee('Accept')
                    ->click('@accept-button');

            $browser->waitForText("Offer #{$offer->id} has been accepted")
                ->assertSee("Offer #{$offer->id} has been accepted");
        });
    }
}
