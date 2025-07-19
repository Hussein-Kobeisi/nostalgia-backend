<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Model;

abstract class Controller
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

        if($id){
            $object = $modelClass::find($id);
        }else{
            $object = new $modelClass;
        }

        $data = $request->only($object->getFillable());

        foreach($data as $field=>$value){
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

        if($id){
            $object = $modelClass::find($id);
            
            if(static::class == UserController::class){
                CapsuleController::deleteCapsulesByUserId($id);
            }
            elseif(static::class == CapsuleController::class){
                CapsuleMediaController::deleteCapsuleMediaByCapsuleId($id);
            }

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
