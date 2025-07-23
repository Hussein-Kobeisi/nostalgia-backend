<?php

namespace App\Services;

class ControllerService
{
    protected $modelClass;

    public function __construct($modelClass){
        $this->modelClass = $modelClass;
    }

    public function new(){
        return new $modelClass;
    }

    public function getAll(){
        return $this->modelClass::all();
    }

    public function findById($id){
        return $this->modelClass::find($id);
    }

    public function createOrUpdate($data, $id = null){
        $object = $id ? $this->modelClass::find($id) : new $this->modelClass;
        
        foreach($data as $field=>$value){
            if($value != null && $value != '')
                $object[$field] = $value;
        }

        $object->save();
        return $object;
    }

    public function delete($id)
    {
        $object = $this->modelClass::find($id);
        $object?->delete();
        return $object;
    }
}
