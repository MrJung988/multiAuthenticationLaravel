<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function authenticate(Request $request){
        // dd($request->all());
        $attributes=$this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::guard('admin')->attempt($attributes, $request->get('remember'))){
            return redirect()->route('admin.dashboard')->with('success','You are successfully logged in.');
        }else{
            return back()->withInput($request->only('email'))->with('error', 'Credentials does not match!');
        }
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    function logout(){
         Auth::guard('admin')->logout();
         return redirect()->route('admin.login');
    }
}
     