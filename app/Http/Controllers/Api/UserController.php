<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request){

        $user = User::create($request->validated());

        $token = $user->createToken("authToken")->plainTextToken;

        $totalPoints = $user->tasks->sum('points');

        $user["token"] = "Bearer ".$token;
        $user["points"] = $totalPoints;

        return [
            "success" => true,
            "user" => $user,
        ];
    }

    public function login(UserRequest $request){
        if(Auth::attempt($request->validated())){

            $user = auth()->user();

            $token = $user->createToken("authToken")->plainTextToken;

            $user["token"] = "Bearer ".$token;

            $user["points"] = (int)$user->tasks()->where('is_confirmed', true)->sum('points');

            return [
                "success" => true,
                "user" => $user,
            ];
        }
        return [
            "success" => false,
        ];

    }

    public function logout(Request $request){
        return [
            "success" => auth()->user()->tokens()->delete()
        ];
    }
}
