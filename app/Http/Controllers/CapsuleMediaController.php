<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapsuleMedia;
use App\Models\Capsule;

class CapsuleMediaController extends Controller
{
    protected static $modelClass = CapsuleMedia::class;

    static function findCapsuleMediaByCapsuleId($capid){
        if($capid){
            $media = CapsuleMedia::where('capsule_id', $capid)->get();

            $response = [];
            $response["status"] = "success";
            $response["payload"] = $media;

            return json_encode($response, 200);
        }

        $response = [];
        $response["status"] = "failure";

        return json_encode($response, 404);
    }

    static function deleteCapsuleMediaByCapsuleId($capid){
        if($capid){
            $media = Capsule::where('user_id', $capid)->get();

            foreach($media as $m){
                CapsuleController::delete($m->id);
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
