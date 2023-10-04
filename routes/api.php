<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RateController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerRatesController;
use App\Http\Controllers\Api\UtilitiesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/getCustomers', [CustomerController::class, 'getCustomers']);

Route::get('/getCustomerRate', [CustomerRatesController::class, 'getCustomerRate']);

Route::get('/getRoles', [UtilitiesController::class, 'getRoles']);
Route::get('/getModalities', [UtilitiesController::class, 'getModalities']);
Route::get('/getPaymentMethods', [UtilitiesController::class, 'getPaymentMethods']);

Route::post('/addPaymentToCustomerRate', [CustomerRatesController::class, 'addPaymentToCustomerRate']);