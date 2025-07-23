<?php

namespace App\Services;
use App\Models\Capsule;

class CapsuleService
{
    static function getAllUnscopedWithoutSurpriseByUserID($id){
        return Capsule::withoutGlobalScopes()->where('user_id', $id)->where('surprise', false)->get();
    }

    static function getAllUnscopedByUserID($id){
        return Capsule::withoutGlobalScopes()->where('user_id', $id)->get();
    }
}