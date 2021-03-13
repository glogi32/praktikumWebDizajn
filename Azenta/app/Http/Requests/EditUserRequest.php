<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            "FirstName" => ["required","regex:/^[A-z]{1,20}$/"],
            "LastName" => ["required","regex:/^[A-z]{1,20}$/"],
            "Email" => ["required","email"],
            "Password" => ["required","regex:/^[A-z\d_-|\/!]{4,30}$/"],
            "userImage" => "mimes:jpeg,jpg,png|max:5000"
        ];
    }
}
