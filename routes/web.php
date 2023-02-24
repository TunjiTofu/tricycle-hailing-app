<?php

use App\Events\CarMoved;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\KekeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Rider\RiderController;
use App\Http\Controllers\Rider\RiderProfileController;
use App\Http\Controllers\Rider\TripHistoryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

    });
});

Route::get('/app', function(){
    return view('map');
});

Route::get('/move', function(){
    event(new CarMoved(-24.344, 131.031));
});
