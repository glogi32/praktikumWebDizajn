<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            "title" => ["required","regex:/^[A-Za-z0-9 .'?!,@$#-_\n\r\s]{3,120}$/"],
            "text" => "required",
            "image" => "required|mimes:jpeg,jpg,png|max:10000"
        ];
    }
}
