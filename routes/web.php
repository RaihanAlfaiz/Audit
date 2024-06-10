<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ToolsController;

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
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{id}/update', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/profile', [UserController::class, 'store'])->name('profile.store');
    Route::get('/profile/{id}/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}/update', [UserController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [UserController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Rute-rute yang sudah ada sebelumnya
    Route::get('/event', [EventController::class, 'index'])->name('event');
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/{id}/show', [EventController::class, 'show'])->name('event.show');
    Route::get('/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/event/{id}/update', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/{id}', [EventController::class, 'destroy'])->name('event.destroy');
    Route::get('/events', [EventController::class, 'index'])->name('event.index');

    // Rute untuk mendapatkan harga paket berdasarkan package_id
    Route::get('/get-package-price/{packageId}', [EventController::class, 'getPackagePrice']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('booking');
    Route::get('/booking/create/{eventId}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}/show', [BookingController::class, 'show'])->name('booking.show');
    Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}/update', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::get('/booking/print/{id}', [BookingController::class, 'print'])->name('booking.print');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/package', [PackageController::class, 'index'])->name('package');
    Route::get('/package/create', [PackageController::class, 'create'])->name('package.create');
    Route::post('/package', [PackageController::class, 'store'])->name('package.store');
    Route::get('/package/{id}/show', [PackageController::class, 'show'])->name('package.show');
    Route::get('/package/{id}/edit', [PackageController::class, 'edit'])->name('package.edit');
    Route::put('/package/{id}/update', [PackageController::class, 'update'])->name('package.update');
    Route::delete('/package/{id}', [PackageController::class, 'destroy'])->name('package.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/service', [ServiceController::class, 'index'])->name('service');
    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/service', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/{id}/show', [ServiceController::class, 'show'])->name('service.show');
    Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/service/{id}/update', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    // Route::get('/events', [EventController::class, 'getEvents'])->name('events');
});

<<<<<<< HEAD
=======
Route::middleware(['auth'])->group(function () {
    Route::get('/myprofile', [MyProfileController::class, 'myprofile'])->name('myprofile');
    Route::post('/myprofile/upload', [MyProfileController::class, 'upload'])->name('myprofile.upload');
    Route::patch('/profile/update/{id}', [MyProfileController::class, 'update'])->name('profile.update');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');   
    Route::get('/tools', [ToolsController::class, 'index'])->name('tools');
    Route::get('/tools/{eventId}', [ToolsController::class, 'showChecklist'])->name('tools.checklist');
    Route::post('/tools/{eventId}', [ToolsController::class, 'submitChecklist'])->name('tools.submit');
    Route::post('/tools/updateStatus', [ToolsController::class, 'updateStatus'])->name('tools.updateStatus');

});

>>>>>>> 9e8eddef9024d7ff37d538c43d3e192b6b130788
