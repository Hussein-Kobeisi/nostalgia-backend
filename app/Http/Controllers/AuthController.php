<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request){
        
        if(!($request->has('email') && $request->has('password')))
            return ResponseService::failureResponse('Missing arguments', 422);

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        if (!$token)
            return ResponseService::failureResponse('Unauthorized', 401);

        $user = AuthService::getAuthedUser();

        $authorisation = [  'token' => $token,
                            'type' => 'bearer',];
        return ResponseService::successResponse($user, 200, $authorisation);
    }

    public function register(Request $request){
        if(!($request->has('name') && $request->has('email') && $request->has('password')))
            return ResponseService::failureResponse('Missing arguments', 422);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);

        $authorisation = [  'token' => $token,
                            'type' => 'bearer',];
        return ResponseService::successResponse($user, 200, $authorisation);
    }

    public function logout(){
        Auth::logout();
        return ResponseService::successResponse();
    }

    public function refresh(){
        $user = AuthService::getAuthedUser();
        $token = Auth::refresh();
        $authorisation = [  'token' => $token,
                            'type' => 'bearer',];

        return ResponseService::successResponse($user, 200, $authorisation);
    }

}