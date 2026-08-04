<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequset;
use App\Http\Requests\Auth\RegisterRequset;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequset $request){
        $user = User::create($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message'=>'Welcome!',
            'user'=>new UserResource($user),
            'token'=>$token,
        ],201);
    }
    public function login(LoginRequset $request){
        $user = User::where('email',$request->email)->first();
        if(!$user or !Hash::check($request->password,$user->password)){
            return response()->json([
                'message'=>'Worng Email OR Password',
            ],401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message'=>'Welcome Back!',
            'user'=>new UserResource($user),
            'token'=>$token
        ]);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'LogOut Successfully'
        ]);
    }
}
