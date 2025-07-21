<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CapsuleController;
use App\Http\Controllers\CapsuleMediaController;
use App\Http\Controllers\UserController;

Route::group(['middleware' => 'auth:api'], function(){
    
    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });

    Route::controller(UserController::class)->group(function () {
        // Route::get('/users/{id?}',           'findById');
        Route::post('/add_update_user',     'addOrUpdate');
        Route::post('/delete_user',         'delete');
    });

    Route::controller(CapsuleController::class)->group(function () {
        Route::get('/capsules/user',                    'findCapsulesByUserId');
        Route::post('/add_update_capsule/{id?}',        'addOrUpdate'); //should remove {id?}
        Route::post('/delete_capsule/{id?}',            'delete');      //should remove {id?}
        Route::post('/delete_capsule/user',             'deleteCapsulesByUserId');        
    });

    Route::controller(CapsuleMediaController::class)->group(function () {
        Route::post('/add_update_capsule_media',                    'addOrUpdate'); //should remove {id?}
        Route::post('/delete_capsule_media/{id?}',                  'delete');
        Route::post('/delete_capsule_media/capsule/{capsuleid?}',   'deleteCapsuleMediaByCapsuleId'); //ids array passed to delete batch
    });
});

Route::group(['prefix' => ''], function(){
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users',                 'getPublicData');
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