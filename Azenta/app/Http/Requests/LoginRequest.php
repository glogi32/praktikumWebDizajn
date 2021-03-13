<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "tbEmail" => "required|email",
            "tbPassword" => ["required","regex:/^[A-z\d_-|\/!]{4,30}$/"]
        ];
    }

    public function messages()
    {
        return [
            "tbEmail.required" => "The email field is required!",
            "tbEmail.email" => "Email is not in good format",
            "tbPassword.required" => "The password field is required!",
            "tbPassword.regex" => "Password may contains A-z,0-9,-_\/! and must be between 4 and 30 characters!"
        ];

    }
}
