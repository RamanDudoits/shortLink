<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PersonalLinkController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
            return view('personallink', [
                'user' => $user
            ]);
        }else {
            return view('login');
        }
    }

    public function setShortLink(Request $request){

        Validator::make($request->all(), [
            'link' => 'required|url',
        ])->validate();

        $link = ShortLink::where('link', $request->link)->first();
        $user = User::where('id', Auth::user()->id)->first();
        

        if($link){
            //если ссылка есть, проверить Существует ли уже таккая ссылка у юзера
            foreach ($link->users as $link_user) {
                if ($link_user->id == $user->id) {
                    return view('personallink', [
                        'link' => $link,
                        'user' => $user,
                        'errorReccuring' => 1,
                    ]);
                }
            }
            //Если в базе ссылка есть, а у юзера её нет связать эту ссылки с юзером
            $user->shortLinks()->attach($link->id);
            return view('personallink', [
                'user' => $user,
            ]);
        } else {
            //Создание ссылки, если её нет в базе.
            $user->shortLinks()->create([
                'link' => $request->link,
                'short_link' => Str::random(7),
            ]);

            if($user){
                return view('personallink', [
                    'user' => $user,
                    'success' => 1,
                ])->render();
            }
        }
    }

    public function redirect($short_link){
        $link = ShortLink::where('short_link', $short_link)->firstOrFail();

        return redirect($link->link);
    }

    public function destroy(Request $request)
    {
        $link = ShortLink::where('id', $request->link_id)->firstOrFail();
        $link->delete();
        $user = User::where('id', Auth::user()->id)->first();
        return
            view('personallink', [
                'user' => $user,
                'delete_success' => 1,
            ])->render();
    }
}
