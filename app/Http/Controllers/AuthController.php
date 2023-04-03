<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class AuthController extends Controller {

    public function create(): InertiaResponse {
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request) : RedirectResponse {

        if (!Auth::attempt(
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]),
            true
        )){
            throw ValidationException::withMessages([
                'email' => 'Invalid email or password'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/listings');
    }

    public function destroy(Request $request) : RedirectResponse {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('listing.index');
    }
}
