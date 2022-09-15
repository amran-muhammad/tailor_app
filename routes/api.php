<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ClothController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\NotificationController;


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
Route::post('user/create/new/tailor', [UserController::class, 'create_new_tailor']);
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

//Order
Route::post('orders/delete', [OrderController::class, 'delete_order']);
Route::get('orders/all', [OrderController::class, 'get_all_order']);
Route::get('orders/single', [OrderController::class, 'get_single_order']);
Route::post('orders/create/new/order', [OrderController::class, 'create_new_order']);
Route::post('orders/update/data', [OrderController::class, 'update_order']);
Route::get('orders/sort', [OrderController::class, 'sort_order']);

//Notification
Route::post('notifications/create/new/notification', [NotificationController::class, 'create_new_notification']);
Route::post('notifications/update/data', [NotificationController::class, 'update_notification']);
Route::get('notifications/all', [NotificationController::class, 'get_all_notification']);
Route::get('notifications/single', [NotificationController::class, 'get_single_notification']);
Route::post('notifications/delete', [NotificationController::class, 'delete_notification']);

