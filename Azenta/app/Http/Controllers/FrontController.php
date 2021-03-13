<?php

namespace App\Http\Controllers;

use App\Models\PostsModel;
use App\Models\PropertiesModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $data;
    private $propertiesModel;
    private $userModel;
    private $postModel;

    public function __construct()
    {
        $this->propertiesModel = new PropertiesModel();
        $this->userModel = new UserModel();
        $this->postModel = new PostsModel();
    }

    public function index(){


        $this->data['properties'] = $this->propertiesModel->getAllProperties();
        $properties = $this->propertiesModel->getTop3();
        foreach ($properties as $key=>$p) {
            $description = explode(".", $p->description);
            $properties[$key]->descriptionShort = $description[0] . ".";
        }
        $this->data['top3Properties'] = $properties;
        $this->data['latest3Posts'] = $this->postModel->getLatest3();
        $this->data["currentDate"] = time();
        $this->data["agents"] = $this->userModel->getAllAgents();


        $this->activeLink();
        return view("pages/home",$this->data);
    }





    public function contact(){
        $this->activeLink();
        return view("pages/contact",$this->data);
    }

    public function aboutUs(){
        $this->data["agents"] = $this->userModel->getAllAgents();

        $this->activeLink();
        return view("pages/about-us",$this->data);
    }




    public  function  activeLink(){

        $url = url()->current();
        $explodeUrl = explode("/",$url);
        $route = end($explodeUrl);

        if($route == "home" || $route == "properties" || $route == "about-us" || $route == "blog" || $route == "contact"){
            $page = end($explodeUrl);
        }else{
            $page = "home";
        }


        $activeH = ($page == "home") ? "active" : "";
        $activeP = ($page == "properties") ? "active" : "";
        $activeA = ($page == "about-us") ? "active" : "";
        $activeB = ($page == "blog") ? "active" : "";
        $activeC = ($page == "contact") ? "active" : "";

        $this->data['links'] = [
            "activeH" => $activeH,
            "activeP" => $activeP,
            "activeA" => $activeA,
            "activeB" => $activeB,
            "activeC" => $activeC
        ];

    }


}
