<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login_page(){
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        if($user = Auth::attempt($request->validated())){
            $request->session()->regenerate();
            return redirect()->route('web.home');
        }
        return back()->withErrors([
            "wrong_creds" => "email/password are wrong"
        ])->withInput();
    }
}
