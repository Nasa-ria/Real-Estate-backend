<?php

use App\Http\Controllers\EstateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('signup', [AdminController::class, 'SignUp']);
Route::post('login ', [AdminController::class, 'Login']);
Route::apiResource('estates', EstateController::class);
Route::get('search',EstateController::class,'searching');
Route::get('estate/filter', [EstateController::class, 'filterResults']);



