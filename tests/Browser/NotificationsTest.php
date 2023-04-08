<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NotificationsTest extends DuskTestCase
{

    use DatabaseTruncation;

    /**
     * @group notification
     * @return void
     */
    public function test_notifications_can_be_created_and_marked_as_read(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $listing = Listing::factory()->create();
        $listing->posted_by = $user2->id;
        $listing->sold_at = null;
        $listing->save();

        $this->browse(function (Browser $first, Browser $second) use ($listing, $user1, $user2) {

            //Login as first user and make an an offer on the listing. This will automaticaly create a notification.
            $first->visit('/login')
                ->type('@email', $user1->email)
                ->type('@password', 'password')
                ->click('@login-button');

            $first->waitForLocation("/listings")
                ->assertSee($user1->name);

            $first->visit('/listing/details/' . $listing->id)
                    ->click('@make-an-offer');

            $first->waitForText("Offer has been submitted")
                ->assertSee("Offer has been submitted");

            //Now login as second user and mark notification as read
            $second->visit('/login')
                ->type('@email', $user2->email)
                ->type('@password', 'password')
                ->click('@login-button');

            $second->waitForLocation("/listings")
                ->click('@my_notifications');

            $second->waitForLocation("/notification")
                ->assertSee("Notifications")
                ->assertSee("MARK AS READ")
                ->click('@notification_update');
        });
    }
}
