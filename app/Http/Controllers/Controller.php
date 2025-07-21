<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Model;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    protected static $modelClass = Model::class;

    static function getAll() {
        $modelClass = static::$modelClass;

        $objects = $modelClass::all();

        $response = [];
        $response["status"] = "success";
        $response["payload"] = $objects;

        return json_encode($response, 200);
    }

    static function findById($id){
        $modelClass = static::$modelClass;

        if($id){
            $object = $modelClass::find($id);

            $response = [];
            $response["status"] = "success";
            $response["payload"] = $object;

            return json_encode($response, 200);
        }

        $response = [];
        $response["status"] = "failure";

        return json_encode($response, 404);
    }

    static function addOrUpdate(Request $request, $id=null){
        $modelClass = static::$modelClass;
        $user = auth()->user();
        //add verifications that authed user owns these objects
        if($modelClass == User::class) 
            $id = $user->id;
        if($id){
            $object = $modelClass::find($id);
        }else{
            $object = new $modelClass;
        }

        $data = $request->only($object->getFillable());

        foreach($data as $field=>$value){
            if($value != null && $value != '')
                $object[$field] = $value;
        }

        $object->save();

        $response = [];
        $response["status"] = "success";
        $response["payload"] = $object;

        return json_encode($response, 200);
    }

    static function delete($id){
        $modelClass = static::$modelClass;
        $user = auth()->user();

        if($id){
            $object = $modelClass::find($id);

            //check if capsuleController && user->id == capsule->user_id
            //check if capsuleMediaController and find capsule and check user->id == capsule->user_id

            if(static::class == CapsuleController::class)
                CapsuleMediaController::deleteCapsuleMediaByCapsuleId($id);

            $object->delete();

            $response = [];
            $response["status"] = "success";
            $response["payload"] = $object;

            return json_encode($response, 200);
        }
        elseif($user){
            $object = $modelClass::find($user->id);
            
            CapsuleController::deleteCapsulesByUserId($user->id);

            $object->delete();

            $response = [];
            $response["status"] = "success";
            $response["payload"] = $object;

            return json_encode($response, 200);
        }

        $response = [];
        $response["status"] = "failure";

        return json_encode($response, 404);
    }
}
