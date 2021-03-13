<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            "firstName" => ["required","regex:/^[A-z]{1,30}$/"],
            "lastName" => ["required","regex:/^[A-z]{1,30}$/"],
            "phone" => ["required","regex:/^[0-9]{3}\s?[0-9]{3}\s?[0-9]{0,6}$/"],
            "password" => ["required","regex:/^[A-z\d_-|\/!]{4,30}$/"],
            "email" => ["required","email", "unique:users,email"],
            "userImage" => ["required","mimes:jpeg,jpg,png","max:5000"]

        ];
    }
}
