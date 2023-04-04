<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Log;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class RealtorListingController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Inertia\Inertia\Response
     */
    public function index(Request $request): InertiaResponse {

        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order']) //"..." works like array_merge
        ];

        //Log::info(print_r($filters, true));

        return Inertia::render('Realtor/Index',
                [
                    'filters' => $filters,
                    'listings' => Auth::user()
                        ->listings()
                        ->filter($filters)
                        ->withCount('images') //Counts the number of images per listing
                        ->withCount('offers')
                        ->paginate(5)
                        ->withQueryString()
                ]
        );
    }

    /**
     * Display details of a given listing
     *
     * @param int $id
     * @return Inertia\Inertia\Response
     */
    public function show(int $id): InertiaResponse {

        $listing = Listing::findOrFail($id);

        return Inertia::render('Realtor/Show',
                [
                    'listing' => $listing->load('offers', 'offers.bidder')
                ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Inertia\Inertia\Response
     */
    public function create(): InertiaResponse {
        return Inertia::render('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {

        $request->validate([
            "beds" => "required|numeric|min:0|max:20",
            "baths" => "required|numeric|min:0|max:20",
            "area" => "required|numeric|min:100|max:5000",
            "address" => "required|max:150",
            "city" => "required|max:150",
            "zip" => "required|max:10",
            "state" => "required|string",
            "price" => "required|integer|min:1|max:20000000",
            "comments" => "nullable|string"
            ], [
            "beds.required" => "Please Enter the Number of Beds",
            "baths.required" => "Please Enter the Number of Baths",
            "area.required" => "Please Enter the Area (sq. footage)"
        ]);

        $request->user()->listings()->create([
            "beds" => $request->beds,
            "baths" => $request->baths,
            "area" => $request->area,
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "zip" => $request->zip,
            "price" => $request->price,
            "comments" => $request->comments,
            "status_id" => 1,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        return redirect()->route('realtor.listing.index')->with('success', 'Listing was created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return RedirectResponse|Inertia\Inertia\Response
     */
    public function edit(int $id) {

        $listing = Listing::withTrashed()->findOrFail($id);

        return Inertia::render(
                'Realtor/Edit',
                [
                    'listing' => $listing
                ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {

        $id = (int) $request->id;

        $request->validate([
            "beds" => "required|numeric|min:0|max:20",
            "baths" => "required|numeric|min:0|max:20",
            "area" => "required|numeric|min:100|max:5000",
            "address" => "required|max:150",
            "city" => "required|max:150",
            "zip" => "required|max:10",
            "state" => "required|string",
            "price" => "required|integer|min:1|max:20000000",
            "comments" => "nullable|string"
            ], [
            "beds.required" => "Please Enter the Number of Beds",
            "baths.required" => "Please Enter the Number of Baths",
            "area.required" => "Please Enter the Area (sq. footage)"
        ]);

        $listing = Listing::withTrashed()->findOrFail($id);

        if (Auth::user()->cannot('update', $listing)) {
            return redirect()->route('realtor.listing.index')->with('success', 'Whoops.. You are not authorized to update this llisting');
        }

        $listing->update([
            "beds" => $request->beds,
            "baths" => $request->baths,
            "area" => $request->area,
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "zip" => $request->zip,
            "price" => $request->price,
            "status_id" => 1,
            "posted_by" => Auth::user()->id,
            "comments" => $request->comments,
            "updated_at" => Carbon::now()
        ]);

        return redirect()->route('realtor.listing.index')->with('success', 'Listing was updated');
    }

    /**
     * Remove the specified resource from storage (force delete)
     *
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse {

        $listing = Listing::findOrFail($id);

        if (Auth::user()->cannot('delete', $listing)) {
            return redirect()->route('realtor.listing.index')->with('success', 'Whoops.. You are not authorized to unpublish this listing');
        }

        $listing->delete();

        return redirect()->back()->with('success', 'Listing is now unpublished');
    }

    /**
     * Remove the specified resource from storage (soft-delete)
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse {

        $listing = Listing::withTrashed()->findOrFail($id);

        if (Auth::user()->cannot('forceDelete', $listing)) {
            return redirect()->route('realtor.listing.index')->with('success', 'Whoops.. You are not authorized to delete this listing');
        }

        $listing->forceDelete();

        return redirect()->back()->with('success', 'Listing has been permanently deleted');
    }

    /**
     * Restore a specific resource from soft-delete status
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse {

        $listing = Listing::withTrashed()->findOrFail($id);

        if (!$listing) {
            return redirect()->back()->with('error', 'Hmm... Listing was not found');
        }

        if (Auth::user()->cannot('restore', $listing)) {
            return redirect()->route('realtor.listing.index')->with('success', 'Whoops.. You are not authorized to restore this listing');
        }

        $listing->restore();

        return redirect()->back()->with('success', 'Listing is now published');
    }
}
