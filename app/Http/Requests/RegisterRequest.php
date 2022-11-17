<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|regex:/^[a-z]+$/i|max:255|string|min:4',
            'email' => 'email|required|unique:App\Models\User,email',
            'password' => 'required|min:4',
            'repeat_password' => 'required|min:4|same:password',
        ];
    }
}
