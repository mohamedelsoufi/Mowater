<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('guest:admin')->only('dashboard.login');
//    }

    public function login()
    {
        return view('dashboard.login');
    }

    public function home()
    {
        return view('dashboard.home');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

//        $remember_me = $request->has('remember_me') ? true : false;
        $user = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($user) {
            $request->session()->regenerate();

            return redirect()->route('admin.home');
        }
        return back()->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('dashboard.login');
    }
}
