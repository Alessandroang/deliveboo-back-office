<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\PlateController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\OrderController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//  RESTAURANT API

Route::apiResource("/restaurants", RestaurantController::class)->only(["index", "show"]);
Route::get('/plates-by-restaurant/{restaurant_id}', [PlateController::class, 'platesByRestaurant']);
Route::post('/get-restaurants-by-filters', [RestaurantController::class, 'restaurantsByFilters']);

//  TYPE API

Route::apiResource("types", TypeController::class)->only(["index"]);

// ORDER API

Route::post('/orders', [OrderController::class, 'store']);

// PAYMENT API

Route::get('/generate', [OrderController::class, 'Generate']);
Route::post('/payment', [OrderController::class, 'MakePayment']);

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//  return $request->user();
//});