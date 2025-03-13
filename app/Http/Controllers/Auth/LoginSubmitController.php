<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginSubmitController extends Controller
{

    public function __invoke(LoginRequest $request)
    {
        $requestFields = $request->validated();

        if (Auth::attempt($requestFields)) {
            return redirect()->intended(route('personalLink'));
        }

        return redirect(route('login'))->withErrors(['regError' => 'This user does not exist ']);
    }
}
