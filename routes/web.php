<?php

use App\Events\CarMoved;
use App\Events\SendPosition;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\KekeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Passenger\BookController;
use App\Http\Controllers\Passenger\PassengerController;
use App\Http\Controllers\Passenger\PassengerProfileController;
use App\Http\Controllers\Rider\RiderController;
use App\Http\Controllers\Rider\RiderProfileController;
use App\Http\Controllers\Rider\TripHistoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Route::get('/login', [AdminController::class, 'login'])->name('admin.login');

Route::middleware(['auth', 'verified' ,'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [IndexController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/logout', [IndexController::class, 'destroy'])->name('admin.logout');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/admin/profile', 'index')->name('admin.profile');
        Route::get('/admin/profile-edit', 'edit')->name('admin.profile-edit');
        Route::post('/admin/profile-save', 'update')->name('admin.profile-save');
        Route::get('/admin/password-change', 'passwordChange')->name('admin.password-change');
        Route::post('/admin/password-update', 'passwordUpdate')->name('admin.password-update');
    });

    Route::resource('keke', KekeController::class);
    Route::resource('place', PlaceController::class);
});

Route::middleware(['auth', 'verified', 'role:rider'])->group(function () {
    Route::get('/rider/dashboard', [RiderController::class, 'RiderDashboard'])->name('rider.dashboard');
    Route::get('/rider/logout', [RiderController::class, 'destroy'])->name('rider.logout');
    Route::get('/rider/change-status', [RiderController::class, 'changeStatus'])->name('rider.change.status');

    Route::controller(RiderProfileController::class)->group(function () {
        Route::get('/rider/profile', 'index')->name('rider.profile');
        Route::get('/rider/profile-edit', 'edit')->name('rider.profile-edit');
        Route::post('/rider/profile-save', 'update')->name('rider.profile-save');
        Route::get('/rider/password-change', 'passwordChange')->name('rider.password-change');
        Route::post('/rider/password-update', 'passwordUpdate')->name('rider.password-update');
    });

    Route::controller(TripHistoryController::class)->group(function () {
        Route::get('/rider/starttrip', 'startTrip')->name('rider.start.trip');
        Route::get('/rider/stoptrip', 'stopTrip')->name('rider.stop.trip');
        Route::get('/rider/updatetrip', 'updateTrip')->name('rider.update.trip');
        // Route::get('/rider/updatetripevent/{id}', 'updateTripEvent')->name('rider.update.tripevent');

    });
});

//Update Rider Location
Route::get('/rider/updatetripevent', [TripHistoryController::class, 'updateTripEvent'])->name('rider.update.tripevent');

Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/dashboard', [PassengerController::class, 'PassengerDashboard'])->name('passenger.dashboard');
    Route::get('/passenger/logout', [PassengerController::class, 'destroy'])->name('passenger.logout');

    Route::controller(PassengerProfileController::class)->group(function () {
        Route::get('/passenger/profile', 'index')->name('passenger.profile');
        Route::get('/passenger/profile-edit', 'edit')->name('passenger.profile-edit');
        Route::post('/passenger/profile-save', 'update')->name('passenger.profile-save');
        Route::get('/passenger/password-change', 'passwordChange')->name('passenger.password-change');
        Route::post('/passenger/password-update', 'passwordUpdate')->name('passenger.password-update');
    });

    Route::controller(BookController::class)->group(function () {
        Route::get('/passenger/book', 'index')->name('passenger.book');
        Route::post('/passenger/book/select', 'selectRide')->name('passenger.book.select');
        Route::get('/passenger/book/details', 'storeBookDetailsSession')->name('book.trip.session');

    });
});

// Route::get('/send', function(){
//     $lat = -24.344;
//     $long = 131.031;
//     $location = ["lat"=>$lat, "long"=>$long];
//     event(new SendPosition($location));
//     Log::info('Send Position Success');
// });


Route::get('/app', function(){
    return view('map');
});

Route::get('/move', function(){
    event(new CarMoved(-24.344, 131.031));
});
