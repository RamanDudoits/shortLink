<?php

namespace App\Http\Controllers\ShortLink;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends BaseController
{
    public function __invoke(UserRepository $userRepository)
    {
        return view('personalLink', [
            'user' => $userRepository->getUser(Auth::user()->id)
        ]);
    }
}
