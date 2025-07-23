<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapsuleMedia;
use App\Models\Capsule;
use Illuminate\Support\Facades\Storage;
use App\Services\CapsuleMediaService;
use App\Services\ResponseService;

class CapsuleMediaController extends Controller
{
    protected static $modelClass = CapsuleMedia::class;

    static function findCapsuleMediaByCapsuleId($capid){
        if($capid){
            $media = CapsuleMedia::where('capsule_id', $capid)->get();

            return ResponseService::successResponse($media);
        }

        return ResponseService::failureResponse('Media not found', 404);
    }

    static function deleteCapsuleMediaByCapsuleId($capid){
        if($capid){
            $media = Capsule::where('user_id', $capid)->get();

            foreach($media as $m)
                CapsuleController::delete($m->id);

            return ResponseService::successResponse($media);
        }

        return ResponseService::failureResponse('Media not found', 404);
    }

    static function addMedia(Request $request){
        
        $media = new CapsuleMedia;
        $base64file = $request->input('file64'); 

        $fileName = CapsuleMediaService::saveBase64File($base64file);

        if (!$fileName)
            return ResponseService::failureResponse();

        $media->capsule_id = $request->input('capsule_id');
        $media->file_path =  "/uploads/{$fileName}";

        CapsuleMediaService::saveCapsuleMedia($media);

            

        return ResponseService::successResponse($media);
    }
    
}
