<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\UserLink;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        if($link = ShortLink::where('link', $request->link)->first()){

            foreach ($link->users as $user) {
                if ($user) {
                    return view('personallink', [
                        'link' => $link,
                        'user' => Users::where('id', Auth::user()->id)->first(),
                    ]);
                }
            }
            return 'else';//тут надо привязать к юзеру существующую ссылку
        } //тут записать юзеру новую ссылку

        /*$shrotLink = ShortLink::create([
            'link' => $request->link,
            'short_link' => Str::random(7)
        ]);*/

        //осталось
        //сервис метод по скоращению ссылок
        //проверка на существующую ссылку, если есть привязать существующую ссылку к текущему юзеру, если нет создать новую

        /*if($shrotLink){
            return redirect()->route('personallink')->with('success', 'Short link created.');
        } else{
            return redirect()->route('personallink')->with('error','Short link not created.');
        }*/
        
    }
}
