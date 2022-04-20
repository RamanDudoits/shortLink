<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalLinkController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $user = Users::where('id', Auth::user()->id)->first();
            return view('personallink', [
                'user' => $user
            ]);
        }else {
            return view('login');
        }
    }

    public function setShortLink(Request $request){

        $request->validate([
            'link' => 'required|url',
        ]);

        $shrotLink = ShortLink::create([
            'link' => $request->link,
            'short_link' => '123'
        ]);

        //осталось
        //сервис метод по скоращению ссылок
        //проверка на существующую ссылку, если есть привязать существующую ссылку к текущему юзеру, если нет создать новую

        if($shrotLink){
            return redirect()->route('personallink')->with('success', 'Short link created.');
        } else{
            return redirect()->route('personallink')->with('error','Short link not created.');
        }
        
    }
}
