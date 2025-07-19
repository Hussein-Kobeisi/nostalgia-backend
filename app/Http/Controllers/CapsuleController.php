<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capsule;

class CapsuleController extends Controller
{
    protected static $modelClass = Capsule::class;

    static function findCapsulesByUserId(){

        $user = auth()->user();

        $capsules = Capsule::where('user_id', $user->id)->get();

        $response = [];
        $response["status"] = "success";
        $response["user_id"] = $user->id;
        $response["payload"] = $capsules;

        return json_encode($response, 200);
    }

    static function deleteCapsulesByUserId($userid){
        $user = auth()->user();

        $capsules = Capsule::where('user_id', $user->id)->get();

        foreach($capsules as $cap){
            CapsuleController::delete($cap->id);
        }

        $response = [];
        $response["status"] = "success";
        $response["payload"] = $capsules;

        return json_encode($response, 200);
    }
}
