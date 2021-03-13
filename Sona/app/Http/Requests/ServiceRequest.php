<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            "name" => ["required","regex:/^[\w\s]{1,80}$/"],
            "price" => ["required","numeric","between:0,4000"],
            "iconClassName" => ["required","regex:/^[\w\s-]{1,255}$/"],
            "description" =>  ["required","regex:/^[A-Za-z0-9 .'?!,@$#-_\n\r\s]{10,1850}$/"]
        ];
    }
}
