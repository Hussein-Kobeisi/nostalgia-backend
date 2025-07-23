<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capsule;
use App\Services\ResponseService;
use App\Services\AuthService;


class CapsuleController extends Controller
{
    protected static $modelClass = Capsule::class;
    
    static function findCapsulesByUserId(){

        $user = AuthService::getAuthedUser();
        $capsules = Capsule::withoutGlobalScopes()->where('user_id', $user->id)->where('surprise', false)->get();

        return ResponseService::successResponse($capsules, 200, null);
    }

    static function deleteCapsulesByUserId($userid){
        $user = AuthService::getAuthedUser();
        $capsules = Capsule::where('user_id', $user->id)->get();

        foreach($capsules as $cap){
            CapsuleController::delete($cap->id);
        }

        return ResponseService::successResponse($capsules);
    }
}
