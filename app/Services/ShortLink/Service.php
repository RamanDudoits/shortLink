<?php

namespace App\Services\ShortLink;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Service{
    
    public function setShortLink($linkReq)
    {
        $link = ShortLink::where('link', $linkReq['link'])->first();
        $user = User::where('id', Auth::user()->id)->first();

        if ($link) {
            //если ссылка есть, проверить Существует ли уже таккая ссылка у юзера
            foreach ($link->users as $link_user) {
                if ($link_user->id == $user->id) {
                    return [
                        'here' => '1',
                        'link' => $link,
                        'user' => $user,
                    ];
                }
            }
            //Если в базе ссылка есть, а у юзера её нет связать эту ссылки с юзером
            $user->shortLinks()->attach($link->id);
            return [
                'bind' => '1',
                'user' => $user,
            ];
        } else {
            //Создание ссылки, если её нет в базе.
            $user->shortLinks()->create([
                'link' => $linkReq['link'],
                'short_link' => Str::random(7),
            ]);

            if ($user) {
                return [
                    'user' => $user,
                ];
            }
        }
    }
}