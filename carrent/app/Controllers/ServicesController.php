<?php

namespace app\Controllers;
use app\models\Database;
use app\models\Cars;

class ServicesController extends Controller{

    public function servicesPage(){
        $cars = new Cars(DATABASE::instance());
        $this->loadView("services",['services'=> $cars->getAllServices()]);
    }
}