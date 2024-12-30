<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckForPrice;
use App\Http\Middleware\CheckForAuth;





Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');
Route::get('/', [HomeController::class, 'index'])
    ->name('index');

Route::group(['prefix'=>'traveling'],function(){

    Route::get('/about/{id}', [\App\Http\Controllers\Traveling\TravelingController::class, 'about'])
    ->name('traveling.about');
 
    //booking
    Route::get('/reservation/{id}', [\App\Http\Controllers\Traveling\TravelingController::class, 'makeReservation'])
        ->name('traveling.reservation');

    Route::post('/reservation/{id}', [\App\Http\Controllers\Traveling\TravelingController::class, 'storeReservation'])
        ->name('traveling.reservation.store');

    //paying
    Route::get('/pay/{country_id}', [\App\Http\Controllers\Traveling\TravelingController::class, 'payWithPaypal'])
        ->name('traveling.pay')
        ->middleware(CheckForPrice::class);

    Route::get('/success', [\App\Http\Controllers\Traveling\TravelingController::class, 'success'])
        ->name('traveling.success')
        ->middleware(CheckForPrice::class);

    //deals
    Route::get('/deals', [\App\Http\Controllers\Traveling\TravelingController::class, 'deals'])
        ->name('traveling.deals');

    Route::post('/search-deals', [\App\Http\Controllers\Traveling\TravelingController::class, 'searchDeals'])
        ->name('traveling.deals.search');
        
});



//users pages
Route::get('users/my-bookings', [\App\Http\Controllers\Users\UsersController::class, 'bookings'])
    ->middleware(['auth', 'verified'])
    ->name('users.bookings');

//admin panel

// Admin routes
Route::group(['prefix' => 'admin'], function() {
    // Show the login page
    Route::get('/login', [\App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])
        ->name('view.login')
        ->middleware(CheckForAuth::class);

    // Handle login POST request
    Route::post('/login', [\App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])
        ->name('check.login');

    // Dashboard page (only accessible to authenticated admins)
    Route::get('/index', [\App\Http\Controllers\Admins\AdminsController::class, 'index'])
        ->middleware('auth:admin')
        ->name('admins.dashboard');

    //admins
    Route::get('/all-admins', [\App\Http\Controllers\Admins\AdminsController::class, 'allAdmins'])
        ->name('admins.all.admins');
    
    Route::get('/create-admins', [\App\Http\Controllers\Admins\AdminsController::class, 'createAdmins'])
        ->name('admins.create');
    
    Route::post('/create-admins', [\App\Http\Controllers\Admins\AdminsController::class, 'storeAdmins'])
        ->name('admins.store');

    //countries
    Route::get('/all-countries', [\App\Http\Controllers\Admins\AdminsController::class, 'allCountries'])
        ->name('all.countries');
    Route::get('/create-countries', [\App\Http\Controllers\Admins\AdminsController::class, 'createCountries'])
        ->name('create.countries');
    Route::post('/create-countries', [\App\Http\Controllers\Admins\AdminsController::class, 'storeCountries'])
        ->name('store.countries');
    Route::get('/delete-countries/{id}', [\App\Http\Controllers\Admins\AdminsController::class, 'deleteCountries'])
        ->name('delete.countries');

    //cities
    Route::get('/all-cities', [\App\Http\Controllers\Admins\AdminsController::class, 'allCities'])
        ->name('all.cities');
    Route::get('/create-cities', [\App\Http\Controllers\Admins\AdminsController::class, 'createCities'])
        ->name('create.cities');
    Route::post('/create-cities', [\App\Http\Controllers\Admins\AdminsController::class, 'storeCities'])
        ->name('store.cities');
    Route::get('/delete-cities/{id}', [\App\Http\Controllers\Admins\AdminsController::class, 'deleteCities'])
        ->name('delete.cities');

    //bookings
    Route::get('/all-bookings', [\App\Http\Controllers\Admins\AdminsController::class, 'allBookings'])
        ->name('all.bookings');
    Route::get('/edit-booking/{id}', [\App\Http\Controllers\Admins\AdminsController::class, 'editBookings'])
        ->name('edit.bookings');
    Route::post('/update-booking/{id}', [\App\Http\Controllers\Admins\AdminsController::class, 'updateBookings'])
        ->name('update.bookings');
    Route::get('/delete-booking/{id}', [\App\Http\Controllers\Admins\AdminsController::class, 'deleteBookings'])
        ->name('delete.bookings');


    // Admin logout route
    Route::post('/logout', [\App\Http\Controllers\Admins\AdminsController::class, 'logout'])
        ->name('admin.logout');
});



//logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
