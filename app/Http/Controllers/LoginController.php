<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function  show_login(){
        return view ('login');
    }
    public function check_login(Request $request){
        if(Auth::attempt(['email' => $request->input('username'), 'password' => $request->input('password')])) {
            return redirect()->intended('/admin');
        } else {
            return redirect()->back()->withErrors(['login_error' => 'Invalid credentials']);
        }
}
}
