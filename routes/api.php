<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CapsuleController;
use App\Http\Controllers\CapsuleMediaController;
use App\Http\Controllers\UserController;

Route::get('/capsules', [CapsuleController::class, 'getAll']);
Route::get('/capsules/id/{id?}', [CapsuleController::class, 'findById']);
Route::get('/capsules/user/{userid?}', [CapsuleController::class, 'findCapsulesByUserId']);
Route::post('/add_update_capsule/{id?}', [CapsuleController::class, 'addOrUpdate']);
Route::post('/delete_capsule/{id?}', [CapsuleController::class, 'delete']);
Route::post('/delete_capsule/user/{userid?}', [CapsuleController::class, 'deleteCapsulesByUserId']);

Route::get('/capsule_media', [CapsuleMediaController::class, 'getAll']);
Route::get('/capsule_media/id/{id?}', [CapsuleMediaController::class, 'findById']);
Route::get('/capsule_media/capsule/{capsuleid?}', [CapsuleMediaController::class, 'findCapsuleMediaByCapsuleId']);
Route::post('/add_update_capsule_media/{id?}', [CapsuleMediaController::class, 'addOrUpdate']);
Route::post('/delete_capsule_media/{id?}', [CapsuleMediaController::class, 'delete']);
Route::post('/delete_capsule_media/capsule/{capsuleid?}', [CapsuleMediaController::class, 'deleteCapsuleMediaByCapsuleId']); //ids array passed to delete batch

Route::get('/users', [UserController::class, 'getAll']);
Route::get('/users/{id?}', [UserController::class, 'findById']);
Route::post('/add_update_user/{id?}', [UserController::class, 'addOrUpdate']);
Route::post('/delete_user/{id?}', [UserController::class, 'delete']);

Route::get('login', [UserController::class, 'loginUser']);
Route::post('signup', [UserController::class, 'signupUser']);
