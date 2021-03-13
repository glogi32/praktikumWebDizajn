<?php

namespace app\Controllers;

use app\models\Cars;
use app\models\User;
use app\models\Database;

class AdminController extends Controller{

    private $usersModel;
    private $carsModel;
    public function __construct()
    {
        $this->usersModel = new User(Database::instance());
        $this->carsModel = new Cars(Database::instance());
    } 

    public function adminPage(){

        if(!isset($_SESSION['user']) || $_SESSION['user']->uloga_id != 1){
            $this->redirect("index.php");
        }
        $this->loadView("admin",[ "roles" => $this->usersModel->getAllRoles(),"cars" => $this->carsModel->getAllCars()]);
    }

    public function fillTableUsers(){
        
        
        $users = $this->usersModel->getAllWithRoles();
        if($users){
            $this->json($users);
        }
        else{
            $this->json(["Greska na serveru"],500);
        }
    }

    public function fillTableCars(){
        
        
        $cars = $this->carsModel->getAllCars();
        if($cars){
            $this->json($cars);
        }
        else{
            $this->json(["Greska na serveru"],500);
        }
    }



    public function deleteUser(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $r = $this->usersModel->deleteUser($id);
            if($r){
                $this->json(["delete-user" => "Uspesno brisanje korisnika!"],204);
            }else{
                $this->json(["delete-user" => "Izabrani korisnik ne postoji u bazi!"],404);
            }
        }
        else{
            $this->json(["delete-user" => "Greska na serveru!"],500);
        }
    }

    public function insertUser(){

        if(isset($_POST['send'])){
            $ime = $_POST["ime"];
            $prezime = $_POST["prezime"];
            $email = $_POST["email"];
            $password = md5($_POST["sifra"]);
            
            $putanja = "public/vendor/images/default.jpg";
            $ime_fajla = time()."_default_slika";
            $uloga = $_POST["uloga_id"];
            
            $errors = [];

            $reImePrezime = '/^[A-Z][a-z0-9-A-Z\s]{2,15}$/';
            $rePassword =  '/^[A-Za-z0-9\_-A-Z\s]{4,15}$/';
            
            
            if(!$ime){
                array_push($errors,"Polje za ime je obavezno!");
            }
            elseif(!preg_match($reImePrezime,$ime)){
                array_push($errors,"Ime nije u dobrom formatu!");
            }
    
            if(!$prezime){
                array_push($errors,"Polje za prezime je obavezno!");
            }
            elseif(!preg_match($reImePrezime,$prezime)){
                array_push($errors,"Prezime nije u dobrom formatu!");
            }
    
            if(!$_POST["sifra"]){
                array_push($errors,"Polje za lozinku je obavezno!");
            }
            elseif(!preg_match($rePassword,$_POST["sifra"])){
                array_push($errors,"Lozinka nije u dobrom formatu!");
            }
    
            if(!$email){
                array_push($errors,"Polje za email je obavezno!");
            }
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors,"Email nije u dobrom formatu");
            };

            if(count($errors) == 0){

                $userModel = new User(DATABASE::instance());

                $insert = $userModel->addUser($ime,$prezime,$email,$password,"",$uloga,$putanja,$ime_fajla);
                if($insert){
                    $this->json(['uspesan_insert' => 'Korisnik uspesno registrovan!'],200);
                }
                else{
                    $this->json(['greska_insert' => 'Greska na serveru!'],500);
                }
            }
            else{
                $this->json($errors,422);
            }
        }
    }

    public function updateUser(){
        if(isset($_POST['send'])){
            $ime = $_POST["ime"];
            $prezime = $_POST["prezime"];
            $email = $_POST["email"];
            $password = md5($_POST["sifra"]);
            $uloga = $_POST["uloga_id"];
            $id = $_POST["id"];

            $errors = [];

            $reImePrezime = '/^[A-Z][a-z0-9]{2,15}$/';
            $rePassword =  '/^[A-Za-z0-9\_-]{4,15}$/';
            
            
            if(!$ime){
                array_push($errors,"Polje za ime je obavezno!");
            }
            elseif(!preg_match($reImePrezime,$ime)){
                array_push($errors,"Ime nije u dobrom formatu!");
            }
    
            if(!$prezime){
                array_push($errors,"Polje za prezime je obavezno!");
            }
            elseif(!preg_match($reImePrezime,$prezime)){
                array_push($errors,"Prezime nije u dobrom formatu!");
            }
    
            if(!$_POST["sifra"]){
                array_push($errors,"Polje za lozinku je obavezno!");
            }
            elseif(!preg_match($rePassword,$_POST["sifra"])){
                array_push($errors,"Lozinka nije u dobrom formatu!");
            }
    
            if(!$email){
                array_push($errors,"Polje za email je obavezno!");
            }
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors,"Email nije u dobrom formatu");
            };

            if(count($errors) == 0){

                $userModel = new User(DATABASE::instance());

                $update = $userModel->updateUser($ime,$prezime,$email,$password,$uloga,$id);
                if($update){
                    $this->json(['uspesan_update' => 'Korisnik uspesno registrovan!'],200);
                }
                else{
                    $this->json(['greska_update' => 'Greska na serveru!'],500);
                }
            }
            else{
                $this->json($errors,422);
            }
        }
    }

    public function getOne(){
        if(isset($_GET['id'])){

            $id = $_GET['id'];
            
            $r = $this->usersModel->getOneById($id);
            if($r != null){
                $this->json($r[0],200);
            }
            else{
                $this->json(["get_one" => "Izabrani korisnik ne postoji!"],404);
            }
        }
        else{
            $this->json(["get_one" => "Greska na serveru"],500);
        }
        
    }

    
}