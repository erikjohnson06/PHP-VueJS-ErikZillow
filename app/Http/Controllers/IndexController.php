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

        dd(Listing::where('beds', '>', 4)->where('area', '>', 200)->orderBy('beds', 'desc')->get());

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
