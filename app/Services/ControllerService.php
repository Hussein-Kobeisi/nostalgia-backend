<?php

namespace App\Services;

class ControllerService
{
    protected $modelClass;

    public function __construct($modelClass){
        $this->modelClass = $modelClass;
    }

    public function findOrNew($id = null){
        $object = $id ? $this->findById($id) : new $this->modelClass;
        return $object;
    }

    public function getAll(){
        return $this->modelClass::all();
    }

    public function findById($id){
        return $this->modelClass::find($id);
    }

    public function createOrUpdate($data, $id = null){
        $object = $this->findOrNew($id);
        
        foreach($data as $field=>$value){
            if($value != null && $value != '')
                $object[$field] = $value;
        }

        $object->save();
        return $object;
    }

    public function delete($id){
        $object = $this->modelClass::find($id);
        $object?->delete();
        return $object;
    }

    public function getFillable(){
        $modelClass = $this->modelClass;
        return (new $modelClass)->getFillable();
    }
}
