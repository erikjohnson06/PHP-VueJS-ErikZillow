<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer){

        //Accept this offer
        $offer->update([
            'accepted_at' => Carbon::now()
        ]);

        //Reject all other offers
        $offer->listing->offers()->allOffersExcept($offer)->update([
            'rejected_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', "Offer #{$offer->id} has been accepted.");
    }
}
