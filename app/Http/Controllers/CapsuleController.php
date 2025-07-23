<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capsule;
use App\Services\ResponseService;
use App\Services\AuthService;
use App\Services\CapsuleService;



class CapsuleController extends Controller
{
    protected static $modelClass = Capsule::class;
    
    static function findCapsulesByUserId(){

        $user = AuthService::getAuthedUser();
        $capsules = CapsuleService::getAllUnscopedWithoutSurpriseByUserID($user->id);

        return ResponseService::successResponse($capsules);
    }

    static function deleteCapsulesByUserId($userid){
        $user = AuthService::getAuthedUser();
        $capsules = CapsuleService::getAllUnscopedByUserID($user->id);

        foreach($capsules as $cap)
            CapsuleController::delete($cap->id);

        return ResponseService::successResponse($capsules);
    }
}
