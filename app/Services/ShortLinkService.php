<?php

namespace App\Services;

use App\Models\ShortLink;
use App\Models\User;
use App\Repositories\ShortLinkRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortLinkService
{

    public function __construct(
        protected UserRepository $userRepository,
        protected ShortLinkRepository $shortLinkRepository
    )
    {}

    /**
     * @param array $linkReq
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string
     */
    public function processLink(array $linkReq)
    {
        $handleProcess = $this->setShortLink($linkReq);

        return match ($handleProcess['action']) {
            'self' => view('personalLink', [
                'link' => $handleProcess['link'],
                'user' => $handleProcess['user'],
                'errorReccuring' => 1,
            ]),
            'attach' => view('personalLink', [
                'user' => $handleProcess['user'],
            ]),
            'create' => view('personalLink', [
                'user' => $handleProcess['user'],
                'success' => 1,
            ])->render()
        };
    }

    /**
     * @param $linkReq
     * @return array
     */
    public function setShortLink($linkReq): array
    {
        $link = $this->shortLinkRepository->getShortLinks($linkReq['link']);
        $user = $this->userRepository->getUser(Auth::user()->id);

        /**
         * @var User $link_user
        */
        return match (isset($link->id)){
            true => $this->attachLink($link, $user),
            false => $this->createLink($user, $linkReq)
        };
    }

    /**
     * @param ShortLink $link
     * @param User $user
     * @return array
     */
    private function attachLink(ShortLink $link, User $user): array
    {
        foreach ($link->users as $link_user) {
            if ($link_user->id == $user->id) {
                return [
                    'action' => 'self',
                    'link' => $link,
                    'user' => $user,
                ];
            }
        }
        $user->shortLinks()->attach($link->id);
        return [
            'action' => 'attach',
            'user' => $user,
        ];
    }

    /**
     * @param User $user
     * @param array $linkReq
     * @return array
     */
    private function createLink(User $user, array $linkReq): array
    {
        $user->shortLinks()->create([
            'link' => $linkReq['link'],
            'short_link' => Str::random(7),
        ]);

        return [
            'action' => 'create',
            'user' => $user,
        ];
    }
}
