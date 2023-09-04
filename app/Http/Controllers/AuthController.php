<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Login
    public function login() {
        return view('login');
    }

    // Register
    public function register() {
        return view('register');
    }

    // Dashboard
    public function dashboard()
    {
        $role = Auth::user()->role;
        if ($role == 'admin') {
            return redirect()->route('category#list');
        } else {
            return redirect()->route('user#home');
        }
    }

}
