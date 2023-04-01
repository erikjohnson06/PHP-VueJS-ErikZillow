<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use App\Notifications\OfferMade;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class ListingOfferController extends Controller
{
    public function store(Listing $listing, Request $request){

        //Ensure users are not able to make an offer on a listing already sold
        $this->authorize("view", $listing);

        $request->validate([
            'amount' => 'required|integer|min:1|max:20000000'
        ]);

        $offer = Offer::create([
            'listing_id' => $listing->id,
            'bidder_id' => Auth::user()->id,
            'amount' => (int) $request->amount,
            'created_at' => Carbon::now()
        ]);

        //$listing->offers()->save($offer);
        $offer->save();

        //Notify users of offer
        $listing->owner->notify(
            new OfferMade($offer)
        );

        return redirect()->back()->with('success', 'Offer has been submitted');
    }
}
