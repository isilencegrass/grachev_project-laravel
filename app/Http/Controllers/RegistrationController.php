<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

        // Сохраняем аватар, если есть
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // Создаём пользователя
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'avatar' => $avatarPath,
        ]);

        // Входим сразу после регистрации
        auth()->login($user);

        return redirect()->route('profile')->with('success', 'Регистрация прошла успешно!');
    }
}