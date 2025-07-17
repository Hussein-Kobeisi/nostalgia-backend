<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CapsuleController extends Controller
{
    function getAllCapsules() {
        $capsules = Capsule::all();

        $response = [];
        $response["status"] = "success";
        $response["payload"] = $capsules;

        return json_encode($response, 200);
    }

    function findCapsule($id){
        if($id){
            $capsule = Capsule::find($id);

            $response = [];
            $response["status"] = "success";
            $response["payload"] = $capsule;

            return json_encode($response, 200);
        }

        $response = [];
        $response["status"] = "failure";

        return json_encode($response, 404);
    }

    function findCapsulesByUserId($userid){
        if($userid){
            $capsules = Capsule::where($id);

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
