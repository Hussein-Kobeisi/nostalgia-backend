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
            $capsules = Capsule::where('user_id', $userid);

            $response = [];
            $response["status"] = "success";
            $response["payload"] = $capsules;

            return json_encode($response, 200);
        }

        $response = [];
        $response["status"] = "failure";

        return json_encode($response, 404);
    }

    function addOrUpdateCapsule(Request $request, $id=null){
        if($id){
            $capsule = Capsule::find($id);
        }else{
            $capsule = new Capsule;
        }

        $capsule->user_id = $request['user_id'] ?? $capsule->user_id;
        $capsule->name = $request['name'] ?? $capsule->name;
        $capsule->create_date = $request['create_date'] ?? $capsule->create_date;
        $capsule->open_date = $request['open_date'] ?? $capsule->open_date;
        $capsule->privacy = $request['privacy'] ?? $capsule->privacy;
        $capsule->surprise = $request['surprise'] ?? $capsule->surprise;

        $response = [];
        $response["status"] = "success";
        $response["payload"] = $capsule;

        return json_encode($response, 200);
    }

    function deleteCapsule($id){
        if($id){
            $capsule = Capsule::delete($id);

            $response = [];
            $response["status"] = "success";

            return json_encode($response, 200);
        }

        $response = [];
        $response["status"] = "failure";

        return json_encode($response, 404);
    }
}
