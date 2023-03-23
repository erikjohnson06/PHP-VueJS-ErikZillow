<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class RealtorListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Inertia\Inertia\Response
     */
    public function index(Request $request): InertiaResponse {

        //dd($request->boolean('deleted'));
        //$listings = Listing::latest()

        $filters = [
            'deleted' => $request->boolean('deleted')
        ];

        return Inertia::render('Realtor/Index',
                [
                    'listings' => Auth::user()
                        ->listings()
                        ->latest()
                        ->filter($filters)
                        ->get()
                ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse {

        $listing = Listing::findOrFail($id);

        if (Auth::user()->cannot('delete', $listing)) {
            return redirect()->route('listings.all')->with('success', 'Whoops.. You are not authorized to delete this listing');
        }

        $listing->delete();

        return redirect()->back()->with('success', 'Listing was deleted');
    }
}
