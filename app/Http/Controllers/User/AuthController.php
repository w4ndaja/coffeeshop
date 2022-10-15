<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        return view('user.login', ['title' => 'Login']);
    }

    public function store(Request $request)
    {
        $form = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::guard('user')->attempt($form, $request->remember == 1)) {
            return back()->withInput(['email' => $request->email])->withErrors(['password' => 'The provided credentials do not match our records.',]);
        }

        return redirect()->intended('user.showcase.index');
    }

    public function register(Request $request)
    {
        return view('user.register', ['title' => 'Register New User']);
    }

    public function registerStore(Request $request)
    {
        $form = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);
        $form['role'] = 'User';

        $registeredUser = User::create($form);
        Auth::guard('user')->loginUsingId($registeredUser->id);

        return redirect()->route('user.welcome');
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}
