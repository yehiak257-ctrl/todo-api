<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user = User::create($request->validated());
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'message'=>'Welcome!',
            'user'=>new UserResource($user),
            'token'=>$token,
        ],201);
    }
    public function login(LoginRequest $request){
        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return response()->json([
                'message'=>'Wrong Email OR Password',
            ],401);
            }
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'message'=>'Welcome Back',
                'user'=>new UserResource($user),
                'token'=>$token
            ],200);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'LogOut SuccEssFully',
        ],200);
    }
}
