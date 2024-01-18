<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::POST('/companies', [ApiController::class, 'show']);
Route::POST('/add_company', [ApiController::class, 'store']);
Route::POST('/get_employee', [ApiController::class, 'get_employee']);
Route::POST('/add_employee', [ApiController::class, 'store_employee']);
