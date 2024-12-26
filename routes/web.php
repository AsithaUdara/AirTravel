<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckForPrice;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('traveling/about/{id}', [\App\Http\Controllers\Traveling\TravelingController::class, 'about'])
    ->name('traveling.about');
 
//booking
Route::get('traveling/reservation/{id}', [\App\Http\Controllers\Traveling\TravelingController::class, 'makeReservation'])
    ->name('traveling.reservation');

Route::post('traveling/reservation/{id}', [\App\Http\Controllers\Traveling\TravelingController::class, 'storeReservation'])
    ->name('traveling.reservation.store');

//paying
Route::get('/traveling/pay/{country_id}', [\App\Http\Controllers\Traveling\TravelingController::class, 'payWithPaypal'])
    ->name('traveling.pay')
    ->middleware(CheckForPrice::class);

Route::get('/traveling/success', [\App\Http\Controllers\Traveling\TravelingController::class, 'success'])
    ->name('traveling.success')
    ->middleware(CheckForPrice::class);

//deals
Route::get('traveling/deals', [\App\Http\Controllers\Traveling\TravelingController::class, 'deals'])
    ->name('traveling.deals');

Route::post('/traveling/search-deals', [\App\Http\Controllers\Traveling\TravelingController::class, 'searchDeals'])
    ->name('traveling.deals.search');

//users pages
Route::post('users/my-bookings', [\App\Http\Controllers\Users\UsersController::class, 'bookings'])
    ->name('users.bookings');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
