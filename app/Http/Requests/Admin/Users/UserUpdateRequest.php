<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            "name"                  => "nullable|string|max:255",
            "last_name"             => "nullable|string|max:255",
            "avatar"                => "nullable|string|max:255",
            "phone"                 => "nullable|string|max:255",
            // "email"                 => "nullable|string|unique:users.email|max:255",
        ];
    }
}
