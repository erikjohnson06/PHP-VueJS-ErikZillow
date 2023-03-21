<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index(){
        /*
        return inertia(
                'Index/Index',
                [
                    'message' => 'Hello from inertia'
                ]
                );
        */
/*
        //$listing = Listing::find(10);

        $user = User::find(1);

        dd($user->listings()->where('beds', '>=', 3)->get());
*/
        /*
        $listing = new Listing;
        $listing->beds = 2;
        $listing->baths = 3;
        $listing->area = 2700;
        $listing->city = "Knoxville";
        $listing->state = "TN";
        $listing->address = "733 Baldwin Station Lane";
        $listing->zip = 37922;
        $listing->price = 272000;
        $listing->comments = "Test Comment";
        $listing->status_id = 1;
        //$listing->posted_by = $user->id;
        //$listing->save();

        //$user->listings()->save($listing);

        $user2 = User::find(2);

        $listing->owner()->associate($user2);
        $listing->save();
    */
        //$listing->posted_by = $user2->id;

        //$user2->listings()->save($listing);


        //dd($listing );
        //Listing::where('beds', '>', 4)->where('area', '>', 200)->orderBy('beds', 'desc')->get()

        //dd(Auth::user());

        /*
        Listing::withTrashed()->where('id', 1)->restore();

        $listing = Listing::withTrashed()->where('id', 1)->get();

        dd($listing);

        Listing::find(1)->forceDelete();
*/
        //$listing->delete();


        return Inertia::render(
                'Index/Index',
                [
                    'message' => 'Hello from inertia'
                ]
                );
    }

    public function show(){

        return Inertia::render(
                'Index/Show',
                []
                );
    }
}
