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

    /**
     * @return Inertia\Inertia\Response
     */
    public function create(): InertiaResponse {
        return Inertia::render('Auth/Login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse {

        if (!Auth::attempt(
                $request->validate([
                    'email' => 'required|string|email',
                    'password' => 'required|string'
                ]),
                true
            )) {
            throw ValidationException::withMessages([
                    'email' => 'Invalid email or password'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/listings');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('listing.index');
    }
}
