<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;

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

//Route::resource('listing', ListingController::class)
//        ->only(['index', 'show', 'create', 'store', 'edit']);


Route::controller(ListingController::class)->group(function () {
    Route::get('/listings', 'index')->name('listings.all');

    Route::get('/listing/details/{id}', 'show')->name('listing.show');

    Route::get('/listing/create', 'create')->name('listing.create');
    Route::post('/listing/store', 'store')->name('listing.store');

    Route::get('/listing/edit/{id}', 'edit')->name('listing.edit');
    Route::post('/listing/update', 'update')->name('listing.update');

    Route::delete('/listing/delete/{id}', 'destroy')->name('listing.delete');

});

