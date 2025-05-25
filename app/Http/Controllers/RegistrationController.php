<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function show()
    {
        return view('registration');
    }

    public function check(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'avatar' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        return back()->with('success', 'Регистрация прошла успешно!');
    }
}