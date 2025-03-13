<?php

namespace App\Http\Controllers\ShortLink;

use App\Http\Controllers\Controller;
use App\Services\ShortLinkService;

class BaseController extends Controller
{

    protected $shortLinkService;

    public function __construct(ShortLinkService $shortLinkService)
    {
        $this->shortLinkService = $shortLinkService;
    }
}
