<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebAuthController extends Controller
{
    //
    public function login(): mixed {
        $data = [
            'title' => 'Login Page'
        ];
        return view('Authentication.Login',$data);
    }

    public function registrasi(): mixed {
        $data = [
            'title' => 'Registartion Page'
        ];
        return view('Authentication.Registration',$data);
    }

    public function forgotPassword(Request $request){
        $data = [
            'title' => 'Forgot Password Page'
        ];
        return view('Authentication.ForgotPassword',$data);
    }
}
