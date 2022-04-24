<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\UserLink;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        $link = ShortLink::where('link', $request->link)->first();
        $user = Users::where('id', Auth::user()->id)->first();
        

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
                ]);
            }
        }
    }

    public function redirect($short_link){
        $link = ShortLink::where('short_link', $short_link)->firstOrFail();

        return redirect($link->link);
    }
}
