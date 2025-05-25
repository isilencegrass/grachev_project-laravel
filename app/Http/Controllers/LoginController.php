<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function check(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // ЛОГИКА ПРОВЕРКИ ПОЛЬЗОВАТЕЛЕЙ ЗДЕСЬ


        return back()->with('success', 'Вход выполнен!');
    }
}