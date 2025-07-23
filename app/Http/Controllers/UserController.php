<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\ResponseService;

class UserController extends Controller
{
    protected static $modelClass = User::class;

    function getPublicData() {

        $users = User::all()->toArray();

        $filteredUsers = array_map(function($user){
            return [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'img' => '/storage/uploads/pic.png'
            ];
        }, $users);

        return ResponseService::successResponse($filteredUsers);
    }
}
