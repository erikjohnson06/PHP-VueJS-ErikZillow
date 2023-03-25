<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\UserController;

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
    Route::get('/listings', 'index')->name('listings.all');
    Route::get('/listing/details/{id}', 'show')->name('listing.show');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('realtor')->name('realtor.')->group(function () {

        Route::resource('listing', RealtorListingController::class)
            ->only(['index', 'edit', 'update', 'create', 'store', 'destroy'])
            ->withTrashed(); //Allows use with soft deleted models

        Route::name('listing.restore')
            ->put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])
            ->withTrashed();

        Route::name('listing.delete')
            ->put('listing/{listing}/delete', [RealtorListingController::class, 'delete'])
            ->withTrashed();
    });
});