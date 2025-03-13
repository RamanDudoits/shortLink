<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function __invoke()
    {
        if (Auth::check()) {
            return redirect(route('personalLink'));
        } else {
            return redirect(route('login'));
        }
    }
}
