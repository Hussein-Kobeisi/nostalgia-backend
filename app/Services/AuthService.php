<?php

namespace App\Services;

class AuthService{
    static function getAuthedUser(){
        return auth()->user();
    }
}