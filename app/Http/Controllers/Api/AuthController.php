<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;


class AuthController extends Controller
{
        public function register(RegisterRequest $request){
        $user = User::create($request->validated());
        $token = auth('api')->login($user);
        return response()->json([
            'message'=>'Welcome!',
            'user'=>new UserResource($user),
            'token'=>$token,
        ],201);
    }
    public function login(LoginRequest $request){
        $credentials = $request->only('email','password');
        if(!$token=auth('api')->attempt($credentials)){
            return response()->json([
                'message'=>'Wrong Email OR Password',
            ],401);
        }
        return response()->json([
            'message'=>'Welcome Back!',
            'user'=>new UserResource(auth('api')->user()),
            'token'=>$token
        ]);
    }
    public function logout(){
        auth('api')->logout();
        return response()->json([
            'message'=>'LogOut Successfully',
        ]);
    }

}
