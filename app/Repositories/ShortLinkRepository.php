<?php

namespace App\Repositories;

use App\Models\ShortLink;

class ShortLinkRepository
{
    public function getShortLinks(string $link): ?ShortLink
    {
        return ShortLink::where('link', $link)->first();
    }

    public function getShortLinkOrFail(int $id): ?ShortLink
    {
        return ShortLink::where('id', $id)->firstOrFail();
    }
}
