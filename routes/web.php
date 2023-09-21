<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\SubFamilyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
--------------------------------------------------------------------------
 Web Routes
--------------------------------------------------------------------------

 Here is where you can register web routes for your application. These
 routes are loaded by the RouteServiceProvider within a group which
 contains the "web" middleware group. Now create something great!

*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user-information', [DashboardController::class, 'getAuthUserInformation'])->name('user.information');
    
    /**
     * Rates - Families - Subfamilies
     */
    Route::resource('/families', FamilyController::class);
    Route::get('/getFamilies', [FamilyController::class, 'getFamilies']);
    
    Route::resource('/subfamilies', SubFamilyController::class);
    Route::get('/getSubFamilies', [SubFamilyController::class, 'getSubFamilies']);

    Route::resource('/rates', RateController::class);
    Route::get('/getRates', [RateController::class, 'getRates']);
    
    Route::resource('/customers', CustomerController::class);
    Route::get('/getCustomers', [CustomerController::class, 'getCustomers']);
    
    Route::resource('/users', UserController::class);
    Route::get('/getUsers', [UserController::class, 'getUsers']);
});





require __DIR__.'/auth.php';

