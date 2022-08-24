<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function loginUser(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('user.profiles'));
        }
        return back()->withErrors([
            'error' => 'Incorrect email or password.'
        ]);
    }

    public function registerPage()
    {
        return view('register');
    }

    public function registerUser(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        auth()->login($user);
        return redirect()->intended(route('user.profile',$user->id));
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();
        return redirect()->route('auth.login.page');
    }
}
