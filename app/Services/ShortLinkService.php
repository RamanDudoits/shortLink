<?php

namespace App\Services;

use App\Models\ShortLink;
use App\Models\User;
use App\Repositories\ShortLinkRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ShortLinkService
{

    public function __construct(
        protected UserRepository $userRepository,
        protected ShortLinkRepository $shortLinkRepository
    )
    {}

    /**
     * @param array $linkReq
     * @return Application|Factory|View
     */
    public function processLink(array $linkReq)
    {
        $result = $this->setShortLink($linkReq);

        return match ($result['action']) {
            'self' => view('personalLink', [
                'link' => $result['link'],
                'user' => $result['user'],
                'errorReccuring' => true,
            ]),
            'attach' => view('personalLink', [
                'user' => $result['user'],
            ]),
            'create' => view('personalLink', [
                'user' => $result['user'],
                'successCreated' => true,
            ]),
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
        return match (isset($link->id) && ($linkReq['user_short'] == $link->short_link || empty($linkReq['user_short']))){
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
        $this->userRepository->attachLinkByUser($user, $link);
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
        $this->userRepository->createLinkForUser($user, $linkReq);

        return [
            'action' => 'create',
            'user' => $user,
        ];
    }
}
