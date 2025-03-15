<?php

namespace App\Repositories;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserRepository
{
    public function createUser(array $data): ?User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function getUser(int $id): ?User
    {
        return User::where('id', $id)->first();
    }

    public function createLinkForUser(User $user, array $linkReq): void
    {
        $user->shortLinks()->create([
            'name' => $linkReq['name'] ?? null,
            'link' => $linkReq['link'],
            'short_link' => $linkReq['user_short'] ?? Str::random(7),
        ]);
    }

    public function attachLinkByUser(User $user, ShortLink $link): void
    {
        $user->shortLinks()->attach($link->id);
    }
}
