<?php

namespace app\Controllers;
use app\models\Cars;
use app\models\Database;
use app\models\Blog;

class HomeController extends Controller{

    private $carsModel;
    private $blogModel;

    public function __construct()
    {
        $this->carsModel = new Cars(Database::instance());
        $this->blogModel = new Blog(Database::instance());
    }

    public function homePage(){
        
        $this->loadView("home",["allCars" => $this->carsModel->getAllCars(),"services" => $this->carsModel->getAllServices(),"featuredPosts" => $this->blogModel->getAllFeatured()]);
        
    }
}