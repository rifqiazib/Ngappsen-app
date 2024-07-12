<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function doLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return Redirect::route('login')->withErrors($validator)->withInput();
        }
        
        $user = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($user)) {
            return view('dashboard.index');
        } else {
            return "ASSAS";
            // return Redirect::back()->withInput()->with('failed', 'Login Failed!');
        }
    }
    
    public function logout() {
        Auth::logout();
        session()->flush();
        return redirect(route('login'));
    }
}
