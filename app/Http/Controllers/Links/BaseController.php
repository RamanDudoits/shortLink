<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Controller;
use App\Repositories\ShortLinkRepository;

abstract class BaseController extends Controller
{
    public function __construct(
        protected ShortLinkRepository $shortLinkRepository
    )
    {}
}
