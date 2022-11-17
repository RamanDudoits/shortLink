<?php

namespace App\Http\Controllers\ShortLink;

use App\Http\Requests\DestroyRequest;
use App\Http\Requests\PersonalLinkRequest;
use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PersonalLinkController extends BaseController
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

    public function setShortLink(PersonalLinkRequest $request){

        $linkReq = $request->validated();
        
        $result = $this->service->setShortLink($linkReq);

        if(isset($result['here']) && $result['here'] > 0){
            //если ссылка есть, проверить Существует ли уже таккая ссылка у юзера
            return view('personallink', [
                'link' => $result['link'],
                'user' => $result['user'],
                'errorReccuring' => 1,
            ]);
                
        }elseif(isset($result['bind']) && $result['bind'] > 0){
            //Если в базе ссылка есть, а у юзера её нет связать эту ссылки с юзером
            return view('personallink', [
                'user' => $result['user'],
            ]);
        } else {
            //Создание ссылки, если её нет в базе.
            return view('personallink', [
                'user' => $result['user'],
                'success' => 1,
            ])->render();
        }
    }

    public function redirect(ShortLink $short_link){
        return redirect($short_link->link);
    }

    public function destroy(DestroyRequest $request)
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
