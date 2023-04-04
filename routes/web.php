<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RealtorListingAcceptOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserController;
use Inertia\Inertia;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider and all of them will
  | be assigned to the "web" middleware group. Make something great!
  |
 */

Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('logout');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store')->name('register.store');
});

Route::controller(ListingController::class)->group(function () {
    Route::get('/listings', 'index')->name('listing.index');
    Route::get('/listing/details/{id}', 'show')->name('listing.show');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('realtor')->name('realtor.')->group(function () {

        Route::resource('listing', RealtorListingController::class)
            ->withTrashed(); //Allows use with soft deleted models

        Route::name('offer.accept')
            ->put('offer/{offer}/accept', RealtorListingAcceptOfferController::class);

        Route::name('listing.restore')
            ->put('listing/{listing}/restore', [RealtorListingController::class, 'restore']);

        Route::name('listing.delete')
            ->put('listing/{listing}/delete', [RealtorListingController::class, 'delete']);

        Route::resource('listing.image', RealtorListingImageController::class)
            ->only(['create', 'store', 'destroy'])
            ->withTrashed();
    });

    Route::resource('listing.offer', ListingOfferController::class)
        ->only(['store']);

    Route::resource('notification', NotificationController::class)
        ->only(['index', 'update']);
});

Route::get('/email/verify', function () {
    return Inertia::render('Auth/VerifyEmail');
})->middleware('auth')->name("verification.notice");

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('listing.index')->with('success', 'Thank you. Your enail address has been verified.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
