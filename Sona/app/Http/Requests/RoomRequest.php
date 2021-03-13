<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            "name" => ["required","regex:/^[\w\s]{1,30}$/"],
            "size" => ["required","numeric","integer","between:30,450"],
            "maxPersons" => ["required","numeric","integer","between:1,20"],
            "beds" => ["required","numeric","integer","between:1,20"],
            "price" => ["required","numeric","between:60,4000"],
            "description" =>  ["required","regex:/^[A-Za-z0-9 .'?!,@$#-_\n\r\s]{10,1850}$/"],
            "availableRooms" => ["required","integer","between:0,50"],
            "pricePercentage" => ["numeric","between:0,10"],
            "roomImage" => ["required","mimes:jpeg,jpg,png","max:5000"]
        ];
    }
}
