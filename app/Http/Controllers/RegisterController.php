<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {

        if (Auth::check()) {
            return redirect(route('personallink'));
        }

        $validated = $request->validated();

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
