<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
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
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:' . User::class,
            'password' => ['required', 'string', 'confirmed',
                    Rules\Password::min(8)
                    ->letters()
                    ->numbers()
                    ->uncompromised()
            ]
        ]);

        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password, //Mutator in User model automatically hashes password
        ]);

        Auth::login($user); //Auto-login user

        event(new Registered($user));

        return redirect()->route('listing.index')->with('success', 'Welcome! Your account has been created! Please check your inbox for the next steps.');
    }

}
