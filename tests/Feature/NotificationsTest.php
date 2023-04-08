<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;

class NotificationsTest extends TestCase
{

    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_notifications_page_returns_a_successful_response(): void
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)
                ->withSession(['banned' => false])
                ->get('/notification');

        $response->assertOk();
    }

    public function test_notifications_can_be_created(): void
    {

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $listing = Listing::factory()->create();
        $listing->posted_by = $user1->id;
        $listing->sold_at = null;
        $listing->save();

        //Creating an offer will automatically create a notification record in the DB
        $response = $this->actingAs($user2)
                ->withSession(['banned' => false])
                ->post('/listing/' . $listing->id . '/offer', [
                        'amount' => $listing->price
        ]);

        $this->assertDatabaseHas('offers', [
                'listing_id' => $listing->id,
                'bidder_id' => $user2->id
                ]);

        $this->assertDatabaseHas('notifications', [
                'notifiable_id' => $listing->posted_by,
                'type' => 'App\Notifications\OfferMade'
                ]);

        $response->assertRedirect();
    }
}
