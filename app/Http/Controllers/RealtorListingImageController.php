<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing): InertiaResponse {

        $listing->load([
            'images'
        ]);

        return Inertia::render('Realtor/ListingImage/Create',
                [
                    'listing' => $listing
                ]
        );
    }

    public function store(Listing $listing, Request $request): RedirectResponse {

        //dd($request->hasFile('images'), $request->file('images'));

        if (!$request->hasFile('images')) {
            return redirect()->back()->with('error', 'No Images Have Been Selected!');
        }

        $request->validate([
            'images.*' => 'mimes:bmp,jpg,png,jpeg|max:5000' //Allow up to 5 MB
            ], [
            'images.*.mimes' => 'Please ensure that the files you are uploading are in one of following formats: .bmp, .jpg, .jpeg or .png'
        ]);

        foreach ($request->file('images') as $file) {

            $path = $file->store('images', 'public');

            Log::info("path:" . $path);

            $listing->images()->save(
                new ListingImage([
                    'filename' => $path
                    ])
            );
        }

        return redirect()->back()->with('success', 'Images Uploaded');
    }

    public function destroy(Listing $listing, ListingImage $image) : RedirectResponse {

        Storage::disk('public')->delete($image->filename);

        $image->delete();

        return redirect()->back()->with('success', 'Image Deleted');
    }
}
