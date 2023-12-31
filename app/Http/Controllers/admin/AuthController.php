<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\authRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {

        return  view('admin.auth.login');
    }

    public function login(authRequest $request)
    {

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công');
        }

        return redirect()->route('login.index')->with('error', 'Email hoặc password nhập sai!');
    }



    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');
    }
}
