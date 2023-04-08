<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

/**
 * Example of a Single Action Controller
 */
class RealtorListingAcceptOfferController extends Controller {

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function __invoke(int $id) : RedirectResponse {

        $offer = Offer::findOrFail($id);

        $listing = $offer->listing;

        //Ensure users are not able to accept an offer on a listing already sold
        $this->authorize("update", $listing);

        //Accept this offer
        $offer->update([
            'accepted_at' => Carbon::now()
        ]);

        $listing->sold_at = Carbon::now();
        $listing->save();

        //Reject all other offers
        $listing->offers()->allOffersExcept($offer)->update([
            'rejected_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', "Offer #{$offer->id} has been accepted.");
    }
}
