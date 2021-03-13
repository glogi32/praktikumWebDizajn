<?php

namespace app\Controllers;
use app\models\Database;
use app\models\Cars;

class CarsController extends Controller{

    private $carsModel;

    public function __construct()
    {
        $this->carsModel = new Cars(Database::instance());
    }

    public function carsPage(){
        
        
        $brojLinkova = $this->carsModel->getNumOfLinks();
        $page = 0;
        if(isset($_GET['pageCars'])){
            $page = ($_GET["pageCars"] -1) * 6;
            
        }
        $this->loadView("cars",["allCars" => $this->carsModel->getAllByPage($page),"numOfLinks" => $brojLinkova]);
    }
    
    public function getCarsByPage(){

        if(isset($_GET['pageCars'])){
            $page = ($_GET["pageCars"] -1) * 6;
            $carsByPage = $this->carsModel->getAllByPage($page);
            $this->json($carsByPage,200);
        }else{
            $this->json(["greska" => "Greska na serveru!"],500);
        }
    }


    public function deleteCar(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $r = $this->carsModel->deleteCar($id);
            if($r){
                $this->json(204);
            }else{
                $this->json(404);
            }
        }
        else{
            $this->json(["delete-user" => "Greska na serveru!"],500);
        }
    }

    public function updateCar(){
        if(isset($_POST['idCars'])){
            $this->carsModel->updateSetDefaulMain();
            $this->carsModel->updateMain($_POST['idCars']);
        }else{
            $this->json(500);
        }
    }

    public function insertCar(){
        if(isset($_POST['btnAddCar'])){
            $name = $_POST['nameCar'];
            $doors = $_POST['ddlDoors'];
            $seats = $_POST['ddlSeats'];
            $lugage = $_POST['lugage'];
            $transmision = $_POST['ddlTransmision'];
            $age = intval($_POST['age']);
            $rating = $_POST['ddlRating'];
            $slika = $_FILES['cimg'];
            $price = intval($_POST['price']);
            $featured = $_POST['ddlFeatured'];
            $main = $_POST['ddlMain'];
            


            $errors = [];


            $reName = '/^[\w\s]{2,15}$/';

            if(!$name){
                array_push($errors,"Polje za naziv je obavezno!");
            }
            elseif(!preg_match($reName,$name)){
                array_push($errors,"Naziv automobila nije u dobrom formatu!");
            }
            if(!$age){
                array_push($errors,"Polje za starost automobila je obavezno!");
            }
            elseif($age < 0 || $age>50){
                array_push($errors,"Starost automobila nije ne sme biti manja od 0 ili veca od 50 godina!");
            }
            if(!$price){
                array_push($errors,"Polje za cenu automobila je obavezno!");
            }
            elseif($price < 0){
                array_push($errors,"Cena automobila ne sme biti manja od 0");
            }
            if($slika['name'] == null){
                array_push($errors,"Morate uneti sliku automobila!");
            }

            $ime_fajla = time()."_".$slika["name"];
                $tip_fajla = $slika["type"];
                $velicina_fajla = $slika["size"];
                $tmp_name = $slika["tmp_name"];
                $alt = $slika['name'];
                $dozvoljeniFormati = ["image/jpg", "image/jpeg", "image/png", "image/gif"];

                $novaPutanja = "public/vendor/images/cars/".$ime_fajla;

                if(!in_array($tip_fajla,$dozvoljeniFormati)){
                    array_push($errors,"Slika nije u dozvoljenom formatu!");
                }
            
                if($velicina_fajla > 6000000){
                    array_push($errors,"Slika ne sme bit veca od 6MB!");
                }

                $uspesanUpload = move_uploaded_file($tmp_name,$novaPutanja);

                if(!$uspesanUpload){
                    array_push($errors,"Greska pri uploadu-u slike!");
                }

            if(count($errors) == 0){

                if($main == 1){
                    $this->carsModel->updateSetDefaulMain();
                }

                $insert = $this->carsModel->insertCar($name,$doors,$seats,$lugage,$transmision,$age,$price,$rating,$novaPutanja,$alt,$featured,$main);

                if($insert){
                    $_SESSION['insert_car'] = "Uspesan unos automobila!";
                    $this->redirect("index.php?page=admin");
                }
                else{
                    $_SESSION['insert_car'] = "Greska na serveru, pokusajte kasnije.";  
                    $this->redirect("index.php?page=admin");
                }

            }else{
                $_SESSION["errors_carInsert"] = $errors;
                $this->redirect("index.php?page=admin");
            }


        }else{
            $this->redirect('index.php?page=admin');
        }
    }
}