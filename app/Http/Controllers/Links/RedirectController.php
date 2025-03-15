<?php

namespace App\Http\Controllers\Links;

use App\Models\ShortLink;

class RedirectController extends BaseController
{
    public function __invoke(ShortLink $shortLink)
    {
        $shortLink->increment('clicks');
        return redirect($shortLink->link);
    }
}
