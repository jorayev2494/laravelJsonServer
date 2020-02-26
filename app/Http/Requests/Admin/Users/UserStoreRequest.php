<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"                  => "required|string|max:255",
            "last_name"             => "required|string|max:255",
            "avatar"                => "nullable|string|max:255",
            "phone"                 => "required|string|max:255",
            "password"              => "required|string|min:6|max:255|confirmed",
            "email"                 => "required|string|unique:users.email|max:255",
        ];
    }
}
