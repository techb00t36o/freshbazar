<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

public function create(): View
{
return view('auth.login');
}



public function store(Request $request): RedirectResponse
{

$request->validate([

'email'=>'required|email',

'password'=>'required'

]);


        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect('/home');
        }

        return back()->with('error', 'Invalid Login Credentials');


}



public function destroy(Request $request): RedirectResponse
{

Auth::logout();

$request->session()->invalidate();

$request->session()->regenerateToken();

return redirect('/');

}

}