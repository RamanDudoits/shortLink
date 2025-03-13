<?php

namespace App\Http\Controllers\Links;

use App\Models\ShortLink;

class RedirectController extends BaseController
{
    public function __invoke(ShortLink $shortLink)
    {
        return redirect($shortLink->link);
    }
}
