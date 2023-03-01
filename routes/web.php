<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use Illuminate\Support\Facades\Route;

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
Route::get('/hello', [IndexController::class, 'show']);

Route::resource('listing', ListingController::class)
    ->only(['index', 'show']);

Route::resource('listing.offer', ListingOfferController::class)
    ->middleware('auth')
    ->only(['store']);

Route::get('login', [AuthController::class, 'create'])
    ->name('login');
Route::post('login', [AuthController::class, 'store'])
    ->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])
    ->name('logout');

Route::resource('user-account', \App\Http\Controllers\UserAccountController::class)
    ->only(['create', 'store']);

Route::prefix('realtor')
    ->name('realtor.')
    ->middleware('auth')
    ->group(function(){
       Route::name('listing.restore')
           ->put(
               'listing/{listing}/restore',
               [\App\Http\Controllers\RealtorListingController::class, 'restore']
           )->withTrashed();
       Route::resource('listing', \App\Http\Controllers\RealtorListingController::class)
        ->withTrashed();
       Route::name('offer.accept')
           ->put(
               'offer/{offer}/accept',
               \App\Http\Controllers\RealtorListingAcceptOfferController::class
           );
       Route::resource('listing.image', \App\Http\Controllers\RealtorListingImageController::class)
        ->only('create', 'store', 'destroy');
    });
