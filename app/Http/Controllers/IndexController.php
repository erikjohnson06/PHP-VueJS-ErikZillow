<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
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

        $listing = new Listing;
        $listing->beds = 2;
        $listing->baths = 3;
        $listing->area = 2700;
        $listing->city = "Knoxville";
        $listing->address_1 = "733 Baldwin Station Lane";
        $listing->address_2 = "";
        $listing->zip = 37922;
        $listing->price = 272000;
        $listing->save();

        dd($listing );
        //Listing::where('beds', '>', 4)->where('area', '>', 200)->orderBy('beds', 'desc')->get()
*/
        return Inertia::render(
                'Index/Index',
                [
                    'message' => 'Hello from inertia'
                ]
                );
    }

    public function show(){
        //return inertia('Index/Show');

        return Inertia::render(
                'Index/Show',
                []
                );
    }
}
