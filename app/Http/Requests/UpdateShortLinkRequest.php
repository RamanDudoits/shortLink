<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShortLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:10',
            'link' => 'required|url',
            'user_short' => [
                'nullable',
                'string',
                'min:3',
                'max:7',
                'alpha_dash',
                Rule::unique('short_links', 'short_link')->ignore($this->route('shortLink')),
            ],
        ];
    }
}
