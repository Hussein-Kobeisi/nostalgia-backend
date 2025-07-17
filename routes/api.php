<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\CapsuleController;
use App\Http\Controllers\User\CapsuleMediaController;
use App\Http\Controllers\User\UserController;

Route::get('/capsules', [CapsuleController::class, 'getAllCapsules']);
Route::get('/capsules/{id?}', [CapsuleController::class, 'findCapsule']);
Route::get('/capsules/{userid?}', [CapsuleController::class, 'findCapsulesByUserId']);
Route::post('/add_update_capsule/{id?}', [CapsuleController::class, 'addOrUpdateCapsule']);
Route::post('/delete_capsule/{id?}', [CapsuleController::class, 'deleteCapsule']);

Route::get('/capsule_media', [CapsuleMediaController::class, 'getAllCapsuleMedia']);
Route::get('/capsule_media/{id?}', [CapsuleMediaController::class, 'findCapsuleMedia']);
Route::get('/capsule_media/{capsuleid?}', [CapsuleMediaController::class, 'findCapsuleMediaByCapsuleId']);
Route::post('/add_update_capsule_media/{id?}', [CapsuleMediaController::class, 'addOrUpdateCapsuleMedia']);
Route::post('/delete_capsule_media/{id?}', [CapsuleMediaController::class, 'deleteCapsuleMedia']);
Route::post('/delete_capsule_media', [CapsuleMediaController::class, 'deleteCapsuleMedia']); //ids array passed to delete batch

Route::get('/users', [UserController::class, 'getAllUsers']);
Route::get('/users/{id?}', [UserController::class, 'findUseer']);
Route::post('/add_update_user/{id?}', [UserController::class, 'addOrUpdateUser']);
Route::post('/delete_user/{id?}', [UserController::class, 'deleteUser']);

Route::get('login', [UserController::class, 'loginUser']);
Route::post('signup', [UserController::class, 'signupUser']);
