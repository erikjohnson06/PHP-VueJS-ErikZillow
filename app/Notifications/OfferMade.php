<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferMade extends Notification {

    use Queueable;

    private Offer $offer;

    /**
     * Create a new notification instance.
     */
    public function __construct(Offer $offer) {
        $this->offer = $offer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage)
                ->line('New Offer Notification for Listing #' . $this->offer->listing_id . ': $' . number_format($this->offer->amount, 2))
                ->action('See Listing', route('realtor.listing.show', ['listing' => $this->offer->listing_id]))
                ->line('Thank you for using ErikZillow!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            'offer_id' => $this->offer->id,
            'listing_id' => $this->offer->listing_id,
            'amount' => $this->offer->amount,
            'bidder_id' => $this->offer->bidder_id,
        ];
    }

}
