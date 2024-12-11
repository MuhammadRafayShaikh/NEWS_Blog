<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginPage()
    {
        if (Auth::check()) {
            return redirect()->route('posts.index');
        } else {
            return view('admin.index');
        }
    }
    public function login(Request $request)
    {
        // $userValidation = validator($request->all(), [
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);
        if (Auth::check()) {
            return view('admin.post');
        }
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('posts.index');
        } else {
            return back()->with('loginFail','Incorrect Email or Password');
        }
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('admin.post');
        } else {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('loginPage');
        }
    }
}
