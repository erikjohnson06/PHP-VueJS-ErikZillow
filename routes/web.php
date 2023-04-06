<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RealtorListingAcceptOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyEmailController;

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

Route::get('/', function () {
    return redirect()->route('listing.index');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('logout');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store')->name('register.store');
});

Route::controller(VerifyEmailController::class)->group(function () {
    Route::get('/email/verify', 'index')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify')->middleware(['signed']);
    Route::get('/email/verification-notification', 'send')->name('verification.send')->middleware(['throttle:6,1']);
})->middleware('auth');

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
