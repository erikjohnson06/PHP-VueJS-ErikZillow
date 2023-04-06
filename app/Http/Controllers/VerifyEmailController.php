<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class VerifyEmailController extends Controller {

    /**
     * @return InertiaResponse
     */
    public function index(): InertiaResponse {
        return Inertia::render('Auth/VerifyEmail');
    }

    /**
     * @param EmailVerificationRequest $request
     * @return RedirectResponse
     */
    public function verify(EmailVerificationRequest $request): RedirectResponse {

        $request->fulfill();

        return redirect()->route('listing.index')->with('success', 'Thank you. Your email address has been verified.');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function send(Request $request): RedirectResponse {

        $request->user()->sendEmailVerificationNotification();

        return redirect()->back()->with('success', 'Verification link sent!');
    }
}
