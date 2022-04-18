<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalLinkController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('personallink', [
                'user_id' => Auth::user()->id
            ]);
        }else {
            return view('login');
        }
    }
}
