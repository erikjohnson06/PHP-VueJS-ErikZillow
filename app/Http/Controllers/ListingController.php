<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class ListingController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Inertia\Inertia\Response
     */
    public function index(Request $request): InertiaResponse {

        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        $listings = Listing::latest()
            ->filter($filters) //Customer local scope method for filtering (see Listing model)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render(
                'Listing/Index',
                [
                    'listings' => $listings,
                    'filters' => $filters
                ]
        );
    }

    /**
     * Display the specified listing
     *
     * @param int $id
     * @return Inertia\Inertia\Response
     */
    public function show(int $id): InertiaResponse {

        $listing = Listing::findOrFail($id);

        //if (Auth::user()->cannot('view', $listing)){
        //    abort(403);
        //}
        //$this->authorize('view', $listing);

        $listing->load(['images']);

        return Inertia::render(
                'Listing/Show',
                [
                    'listing' => $listing
                ]
        );
    }
}
