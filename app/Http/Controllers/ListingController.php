<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Inertia\Response;
use Inertia\Inertia;

class ListingController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Inertia\Inertia\Response
     */
    public function index(): Response {

        $listings = Listing::latest()->get();

        return Inertia::render(
                        'Listing/Index',
                        [
                            'listings' => $listings
                        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {

        return Inertia::render('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //dd($request->all());
        //die("Hello?");

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

        /**/
        Listing::insert([
            "beds" => $request->beds,
            "baths" => $request->baths,
            "area" => $request->area,
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "zip" => $request->zip,
            "price" => $request->price,
            "status_id" => 1,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        return redirect()->route('listings.all')->with('success', 'Listing was created');
    }

    /**
     * Display the specified listing
     *
     * @param int $id
     * @return Inertia\Inertia\Response
     */
    public function show(int $id): Response {

        $listing = Listing::findOrFail($id);

        return Inertia::render(
                        'Listing/Show',
                        [
                            'listing' => $listing
                        ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id) {

        $listing = Listing::findOrFail($id);

        return Inertia::render(
                        'Listing/Edit',
                        [
                            'listing' => $listing
                        ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {

        //dd($request);

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

        $listing = Listing::findOrFail($id);

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
            "updated_at" => Carbon::now()
        ]);

        return redirect()->route('listings.all')->with('success', 'Listing was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id) {

        Listing::findOrFail($id)->delete();
        
        return redirect()->back()->with('success', 'Listing was deleted');
    }

}
