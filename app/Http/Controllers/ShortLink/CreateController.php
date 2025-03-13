<?php

namespace App\Http\Controllers\ShortLink;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalLinkRequest;
use Illuminate\Http\Request;

class CreateController extends BaseController
{
    public function __invoke(PersonalLinkRequest $request)
    {
        $linkReq = $request->validated();
        return $this->shortLinkService->processLink($linkReq);
    }
}
