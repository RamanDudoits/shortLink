<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request){

        if (Auth::check()) {
            return redirect(route('personallink'));
        }

        $requestFields = $request->validated();

        if (Auth::attempt($requestFields)) {
            return redirect()->intended(route('personallink'));
        }

        return redirect(route('login'))->withErrors(['regError' => 'This user does not exist ']);
    }
}
