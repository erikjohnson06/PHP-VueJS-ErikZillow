<?php

namespace Tests\Browser;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Support\Carbon;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ListingsTest extends DuskTestCase {

    use DatabaseTruncation;

    /**
     * @group listings
     * @return void
     */
    public function test_listings_page_can_be_rendered_successfully(): void {

        $this->browse(function (Browser $browser) {
            $browser->visit('/listings')
                ->assertSee('Listings');
        });
    }

    /**
     * @group listings
     * @return void
     */
    public function test_listing_is_displayed_on_listings_page_successfully(): void {

        $listing = Listing::factory()->create();
        $listing->save();

        $this->browse(function (Browser $browser) use ($listing) {
            $browser->visit('/listings')
                ->assertSee('Listings')
                ->assertSee($listing->address);
        });
    }

    /**
     * @group listings
     * @return void
     */
    public function test_listing_details_are_displayed_on_details_page_successfully(): void {

        $listing = Listing::factory()->create();
        $listing->save();

        $this->browse(function (Browser $browser) use ($listing) {
            $browser->visit('/listing/details/' . $listing->id)
                ->assertSee('Basic Info')
                ->assertSee('Estimated Monthly Payment')
                ->assertSee($listing->address)
                ->assertDontSee('Make an Offer'); //Option to make an offer should not be displayed
        });
    }

    /**
     * @group listings
     * @return void
     */
    public function test_make_an_offer_option_is_displayed_to_authenticated_users(): void {

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
                ->assertSee('Make an Offer'); //Option to make an offer should not be displayed
        });
    }

    /**
     * @group listings
     * @return void
     */
    public function test_listing_can_be_created(): void {

        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('@email', $user->email)
                ->type('@password', 'password')
                ->click('@login-button');

            $browser->waitForLocation("/listings")
                ->assertSee($user->name)
                ->click('@new_listing');

            $browser->waitForLocation("/realtor/listing/create")
                ->assertSee("Beds")
                ->assertSee("Baths")
                ->assertSee("Area")
                ->type('@beds', 2)
                ->type('@baths', 3)
                ->type('@area', 2000)
                ->type('@address', '123 Main St.')
                ->type('@city', 'Busy Town')
                ->select('@state', 'TN')
                ->type('@zip', '12345')
                ->type('@price', '100,000')
                ->click('@create-listing');

            $browser->waitForLocation("/realtor/listing")
                ->assertSee("Listing was created");
        });
    }

    /**
     * @group listings
     * @return void
     */
    public function test_listing_can_be_edited(): void {

        $user = User::factory()->create();

        $listing = Listing::factory()->create();
        $listing->posted_by = $user->id;
        $listing->save();

        $this->browse(function (Browser $browser) use ($listing, $user) {
            $browser->visit('/login')
                ->type('@email', $user->email)
                ->type('@password', 'password')
                ->click('@login-button');

            $browser->waitForLocation("/listings")
                ->assertSee($user->name);

            $browser->visit('realtor/listing/' . $listing->id . '/edit')
                ->assertSee("Beds")
                ->assertSee("Baths")
                ->assertSee("Comments")
                ->type('@comments', 'Test Comment')
                ->click('@edit-listing');

            $browser->waitForLocation("/realtor/listing")
                ->assertSee("Listing was updated");
        });
    }

    /**
     * @group listings
     * @return void
     */
    public function test_listing_can_be_deleted(): void {

        $user = User::factory()->create();

        $listing = Listing::factory()->create();
        $listing->posted_by = $user->id;
        $listing->save();

        $this->browse(function (Browser $browser) use ($listing, $user) {
            $browser->visit('/login')
                ->type('@email', $user->email)
                ->type('@password', 'password')
                ->click('@login-button');

            $browser->waitForLocation("/listings")
                ->assertAuthenticated();

            $browser->visit('realtor/listing/')
                ->assertSee($listing->address)
                ->click('@delete-listing');

            $browser->waitForLocation("/realtor/listing")
                ->waitForText("Listing is now unpublished");
        });
    }

    /**
     * @group listings
     * @return void
     */
    public function test_listing_can_be_restored(): void {

        $user = User::factory()->create();

        $listing = Listing::factory()->create();
        $listing->posted_by = $user->id;
        //$listing->deleted_at = Carbon::now();
        $listing->save();

        $this->browse(function (Browser $browser) use ($listing, $user) {
            $browser->visit('/login')
                ->type('@email', $user->email)
                ->type('@password', 'password')
                ->click('@login-button');

            $browser->waitForLocation("/listings")
                ->assertAuthenticated();

            $browser->visit('realtor/listing/')
                ->assertSee($listing->address)
                ->click('@delete-listing');

            $browser->waitForLocation("/realtor/listing")
                ->waitForText("Listing is now unpublished")
                ->click("@unpublished")
                ->waitForText($listing->address)
                ->click('@restore-listing')
                ->waitForText("Listing is now published");
        });
    }
}
