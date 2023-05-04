<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // direct login page
    public function loginPage()
    {
        return view('loginPage');
    }

    // direct register page
    public function registerPage()
    {
        return view('registerPage');
    }

    // direct deshboard
    public function deshboard()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin#itemList');
        } else {
            return redirect()->route('user#homePage');
        }
    }
}