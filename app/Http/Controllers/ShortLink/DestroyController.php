<?php

namespace App\Http\Controllers\ShortLink;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyRequest;
use App\Models\ShortLink;
use App\Models\User;
use App\Repositories\ShortLinkRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestroyController extends BaseController
{
    public function __invoke(
        DestroyRequest $request,
        ShortLinkRepository $shortLinkRepository,
        UserRepository $userRepository
    )
    {
        $link = $shortLinkRepository->getShortLinkOrFail($request->link_id);
        $link->delete();
        $user = $userRepository->getUser(Auth::user()->id);
        return view('personalLink', [
            'user' => $user,
            'delete_success' => 1,
        ])->render();
    }
}
