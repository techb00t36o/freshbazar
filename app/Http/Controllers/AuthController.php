<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class AuthController extends Controller
{

public function login(){

return view('auth.login');

}


public function loginPost(Request $request){

if(Auth::attempt($request->only('email','password'))){

return redirect('/dashboard');

}

return back();

}



public function register(){

return view('auth.register');

}


public function registerPost(Request $request){

$user = new User();

$user->name=$request->name;
$user->email=$request->email;
$user->password=Hash::make($request->password);

$user->save();

return redirect('/login');

}


}