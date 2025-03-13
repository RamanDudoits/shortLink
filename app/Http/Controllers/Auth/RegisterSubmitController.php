<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterSubmitController extends Controller
{
    public function __invoke(
        RegisterRequest $request,
        UserRepository $userRepository
    )
    {
        $validated = $request->validated();

        $user = $userRepository->createUser($validated);

        if(isset($user->id)){
            Auth::login($user);
            return redirect(route('personalLink'));
        }

        return redirect(route('register'))->withErrors(['regError' => 'failed to register User']);
    }
}
