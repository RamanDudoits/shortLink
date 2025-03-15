<?php

namespace App\Http\Controllers\ShortLink;

use App\Http\Controllers\Controller;
use App\Models\ShortLink;

class EditController extends BaseController
{
    public function __invoke(ShortLink $shortLink)
    {
        return view('short-link.edit', ['shortLink' => $shortLink]);
    }
}
