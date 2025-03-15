<?php

namespace App\Http\Controllers\ShortLink;

use App\Http\Requests\UpdateShortLinkRequest;
use App\Models\ShortLink;

class UpdateController extends BaseController
{
    public function __invoke(ShortLink $shortLink, UpdateShortLinkRequest $updateShortLinkRequest)
    {
        $validatedData = $updateShortLinkRequest->validated();

        $shortLink->update($validatedData);

        return redirect()->route('personalLink', $shortLink)->with('success', __('page.update.success'));
    }
}
