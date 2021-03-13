<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends FrontController
{
    public function index(){

        return view("pages.contact",$this->data);
    }
}
