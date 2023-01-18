<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request){
        // Invalidate The Session
        $request->session()->invalidate();

        // Regenerate new CSRF Token
        $request->session()->regenerateToken();

        return redirect()->route('web.home');
    }
}
