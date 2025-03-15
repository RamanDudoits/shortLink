<?php

namespace App\Http\Controllers\ShortLink;

use App\Http\Controllers\Controller;
use App\Services\ShortLinkService;

abstract class BaseController extends Controller
{

    public function __construct(protected ShortLinkService $shortLinkService)
    {}
}
