<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class UserController extends Controller
{
    public function create(): InertiaResponse {
        return Inertia::render('User/Register');
    }

    public function store(Request $request) : RedirectResponse {

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

        return redirect()->route('listings.all')->with('success', 'Welcome! Your account has been created!');
    }
}
