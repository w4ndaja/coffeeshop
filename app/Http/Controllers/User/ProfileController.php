<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::guard('user')->user();
        return view('profile.index', [
            'title' => 'My Profile',
            'user' => $user
        ]);
    }
}
