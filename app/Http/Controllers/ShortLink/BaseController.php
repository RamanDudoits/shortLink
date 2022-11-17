<?php

namespace App\Http\Controllers\ShortLink;

use App\Http\Controllers\Controller;
use App\Services\ShortLink\Service;

class BaseController extends Controller
{

    protected $srvice;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
