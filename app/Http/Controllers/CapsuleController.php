<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capsule;

class CapsuleController extends Controller
{
    protected static $modelClass = Capsule::class;

    public function __construct()
    {
        $this->middleware('auth:api')->only([
            //methods to authorize here
        ]);
    }

    static function findCapsulesByUserId($userid){
        if($userid){
            $capsules = Capsule::where('user_id', $userid)->get();

            $response = [];
            $response["status"] = "success";
            $response["payload"] = $capsules;

            return json_encode($response, 200);
        }

        $response = [];
        $response["status"] = "failure";

        return json_encode($response, 404);
    }

    static function deleteCapsulesByUserId($userid){
        if($userid){
            $capsules = Capsule::where('user_id', $userid)->get();

            foreach($capsules as $cap){
                CapsuleController::delete($cap->id);
            }

            $response = [];
            $response["status"] = "success";
            $response["payload"] = $capsules;

            return json_encode($response, 200);
        }

        $response = [];
        $response["status"] = "failure";

        return json_encode($response, 404);
    }
}
