<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CapsuleController;
use App\Http\Controllers\CapsuleMediaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


Route::group(['middleware' => 'auth:api'], function(){
    
    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });

    Route::controller(UserController::class)->group(function () {
        // Route::get('/users',                 'getAll');
        // Route::get('/users/{id?}',           'findById');
        Route::post('/add_update_user/{id?}',   'addOrUpdate');
        Route::post('/delete_user/{id?}',       'delete');
    });

    Route::controller(CapsuleController::class)->group(function () {
        Route::get('/capsules/user/{userid?}',          'findCapsulesByUserId');
        Route::post('/add_update_capsule/{id?}',        'addOrUpdate');
        Route::post('/delete_capsule/{id?}',            'delete');
        Route::post('/delete_capsule/user/{userid?}',   'deleteCapsulesByUserId');        
    });

    Route::controller(CapsuleMediaController::class)->group(function () {
        Route::post('/add_update_capsule_media/{id?}',              'addOrUpdate');
        Route::post('/delete_capsule_media/{id?}',                  'delete');
        Route::post('/delete_capsule_media/capsule/{capsuleid?}',   'deleteCapsuleMediaByCapsuleId'); //ids array passed to delete batch
    });
});

Route::group(['prefix' => 'guest'], function(){
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
    });

    Route::controller(UserController::class)->group(function () {
        
    });

    Route::controller(CapsuleController::class)->group(function () {
        Route::get('/capsules',                         'getAll');
        Route::get('/capsules/id/{id?}',                'findById');
    });

    Route::controller(CapsuleMediaController::class)->group(function () {
        Route::get('/capsule_media',                                'getAll');
        Route::get('/capsule_media/id/{id?}',                       'findById');
        Route::get('/capsule_media/capsule/{capsuleid?}',           'findCapsuleMediaByCapsuleId');
    });

});