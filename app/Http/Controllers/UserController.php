<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class UserController extends Controller {

    /**
     * @return InertiaResponse
     */
    public function create(): InertiaResponse {
        return Inertia::render('User/Register');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:' . User::class,
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password, //Mutator in User model automatically hashes password
        ]);

        Auth::login($user); //Auto-login user

        event(new Registered($user));

        return redirect()->route('listing.index')->with('success', 'Welcome! Your account has been created!');
    }
}
