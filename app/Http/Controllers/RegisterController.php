<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        if (Auth::check()) {
            return redirect(route('personallink'));
        }

        $validated = $request->validate([
            'name' => 'required|regex:/^[a-z]+$/i|max:255|string|min:4',
            'email' => 'email|required|unique:App\Models\User,email',
            'password' => 'required|min:4',
            'repeat_password' => 'required|min:4|same:password',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        if($user){
            Auth::login($user);
            return redirect(route('personallink'));
        }

        return redirect(route('register'))->withErrors(['regError' => 'failed to registr User']);
    }
}
