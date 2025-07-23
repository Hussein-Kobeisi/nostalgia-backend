<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapsuleMedia;
use App\Models\Capsule;
use Illuminate\Support\Facades\Storage;
use App\Services\CapsuleMediaService;

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
            $response["payload"] = $media;

            return json_encode($response, 200);
        }
        
        $response = [];
        $response["status"] = "failure";

        return json_encode($response, 404);
    }

    static function addMedia(Request $request){
        
        $media = new CapsuleMedia;
        $base64file = $request->input('file64'); 

        $fileName = CapsuleMediaService::saveBase64File($base64file);

        if ($fileName) {
            $media->capsule_id = $request->input('capsule_id');
            $media->file_path =  "/uploads/{$fileName}";
            $media->save();

        }else{
            $response = [];
            $response["status"] = "failure";

            return response()->json(['status' => 'failure', 'base64' => $base64file], 400);
        }

        $response = [];
        $response["status"] = "success";
        $response["payload"] = $media;

        return json_encode($response, 200);
    }
    
}
