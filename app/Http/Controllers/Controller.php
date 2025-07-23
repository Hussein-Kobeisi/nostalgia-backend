<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Model;
use App\Models\User;
use App\Http\Services\ResponseService;
use App\Http\Services\ControllerService;
use App\Http\Services\AuthService;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    protected static $modelClass = Model::class;
    protected static function getControllerService()
    {
        return new ControllerService(static::$modelClass);
    }

    static function getAll() {
        $sevice = static::getControllerService();
        $objects = $sevice->getAll();

        return ResponseService::successResponse($objects);
    }

    static function findById($id){
        $sevice = static::getControllerService();

        if($id){
            $object = $sevice->findById($id);

            return ResponseService::successResponse($object);
        }

        return ResponseService::failureResponse('Object not found', 404);
    }

    static function addOrUpdate(Request $request, $id=null){
        $sevice = static::getControllerService();
        $modelClass = static::$modelClass;
        $user = AuthService::getAuthedUser();

        //Future: add verifications that authed user owns these objects

        if($modelClass == User::class) 
            $id = $user->id;
        $data = $request->only($object->getFillable());

        $object = $sevice->createOrUpdate($data, $id);

        return ResponseService::successResponse($object);
    }

    static function delete($id){
        $sevice = static::getControllerService();
        $user = auth()->user();
        
        $id = $id ?? $user->id;

        $object = $sevice->findById($id);

        //Future: Check if user owns deleted object

        //cascade delete
        if(static::class == UserController::class)
            CapsuleController::deleteCapsulesByUserId($id);
        if(static::class == CapsuleController::class)
            CapsuleMediaController::deleteCapsuleMediaByCapsuleId($id);

        $object = $sevice->delete($id);

        return ResponseService::successResponse($object);
    }
}
