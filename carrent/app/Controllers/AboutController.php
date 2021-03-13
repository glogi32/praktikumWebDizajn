<?php

namespace app\Controllers;


class AboutController extends Controller{

    public function aboutPage(){
        $this->loadView("about");
    }
}