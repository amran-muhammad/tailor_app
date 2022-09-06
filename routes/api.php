<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ClothController;


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


Route::post('login', [UserController::class, 'login']);
Route::post('user/login', [UserController::class, 'user_login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('user/delete', [UserController::class, 'delete_user'])->middleware('auth:sanctum');
Route::post('user/create/new/tailor', [UserController::class, 'create_new_tailor'])->middleware('auth:sanctum');
Route::post('user/create/new/customer', [UserController::class, 'create_new_customer']);
Route::post('user/update/data', [UserController::class, 'update_user'])->middleware('auth:sanctum');
Route::get('user/search', [UserController::class, 'find_a_user']);
Route::get('customers/all', [UserController::class, 'get_all_customer'])->middleware('auth:sanctum');

//Tailor
Route::get('tailors/all', [UserController::class, 'get_all_tailor']);

//cloth
Route::get('cloths/all', [ClothController::class, 'get_all_cloth']);
Route::post('cloths/create/new/cloth', [ClothController::class, 'create_new_cloth'])->middleware('auth:sanctum');
Route::post('cloths/update/data', [ClothController::class, 'update_cloth'])->middleware('auth:sanctum');
Route::post('cloths/delete', [ClothController::class, 'delete_cloth'])->middleware('auth:sanctum');
Route::get('cloths/search', [ClothController::class, 'find_a_cloth']);

