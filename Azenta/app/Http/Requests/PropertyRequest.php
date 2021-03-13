<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            "Name" => ["required","regex:/^[A-Za-z0-9 .'?!,@$#-_\n\r\s]{3,35}$/"],
            "Price" => "required|gt:100",
            "Address" => ["required","regex:/^[A-Za-z0-9 .'?!,@$#-_\n\r\s]{3,35}$/"],
            "Description" => ["required","regex:/^[A-Za-z0-9 .'?!,@$#-_\n\r\s]{10,1850}$/"],
            "DateExpire" => "required|after:today",
            "Image" => "required|mimes:jpeg,jpg,png|max:10000"
        ];
    }
}
