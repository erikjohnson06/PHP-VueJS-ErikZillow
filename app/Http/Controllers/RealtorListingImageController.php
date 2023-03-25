<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing): InertiaResponse {

        return Inertia::render('Realtor/ListingImage/Create',
                [
                    'listing' => $listing
                ]
        );
    }

    public function store(Listing $listing, Request $request){

        //dd($request->hasFile('images'), $request->file('images'));

        if ($request->hasFile('images')){

            foreach ($request->file('images') as $file){

                $path = $file->store('images', 'public');

                Log::info("path:" . $path);

                $listing->images()->save(
                    new ListingImage([
                        'filename' => $path
                    ])
                );
            }
        }

        return redirect()->back()->with('success', 'Images Uploaded');
    }
}
