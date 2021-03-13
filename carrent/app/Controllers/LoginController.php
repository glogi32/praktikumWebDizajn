<?php

namespace app\Controllers;
use app\models\User;
use app\models\Database;


class LoginController extends Controller{
    
    
    public function login($request){
        
        if(isset($request["btnLogin"])){

            $userModel = new User(DATABASE::instance());

            $email = $request["email"];
            $password = md5($request["psw"]);
            $errors = [];

            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                array_push($errors,"Email nije u dobrom formatu");
            }
            
            $user = $userModel->getOneUserByEmailAndPass($email,$password);

            if(!$user){
                array_push($errors,"Pogresna lozinka ili korisnik nije registrovan!");
                $this->redirect("index.php?page=home");
            }

            if($user){
                $_SESSION["user"] = $user;
                $_SESSION["errors"] = null;
                if($user->uloga_id == 1){
                    $this->redirect("index.php?page=admin");
                }else{
                    $this->redirect("index.php?page=home");
                }
            }
            $_SESSION['error_login'] = $errors;
            
        }
        else{
            array_push($errors,"Greska na serveru!");
            $_SESSION['error_login'] = $errors;
            $this->redirect("index.php?page=home");
        }
    }

    public function signup($request){


        if(isset($request["btnSignUp"])){

            $ime = $request["fname"];
            $prezime = $request["lname"];
            $email = $request["e_mail"];
            $password = md5($request["pass"]);
            $about = $request["about"];

            $novaPutanja = "public/vendor/images/default.jpg";
            $ime_fajla = time()."_default_slika";
            $uloga = 2;
            $slika = $_FILES["fimg"];
            $errors = [];
            
            
            
            if(!empty($slika['name'])){
                $ime_fajla = time()."_".$slika["name"];
                $tip_fajla = $slika["type"];
                $velicina_fajla = $slika["size"];
                $tmp_name = $slika["tmp_name"];

                $dozvoljeniFormati = ["image/jpg", "image/jpeg", "image/png", "image/gif"];

                $novaPutanja = "public/vendor/images/users/".$ime_fajla;

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
            }

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
    
            if(!$request["pass"]){
                array_push($errors,"Polje za lozinku je obavezno!");
            }
            elseif(!preg_match($rePassword,$request["pass"])){
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

                $insert = $userModel->addUser($ime,$prezime,$email,$password,$about,$uloga,$novaPutanja,$ime_fajla);
                if($insert){
                    $_SESSION["signup"] = "Uspesna registracija!";
                    $this->redirect("index.php?page=home");
                }
                else{
                    $_SESSION["sign up"] = "Greska na serveru, pokusajte kasnije.";  
                    $this->redirect("index.php?page=home");
                }
            }
            else{
                $_SESSION["signup_errors"] = $errors;
                $this->redirect("index.php?page=home");
            }
        }
    }

    public function logout(){
        
        $_SESSION["user"] = null;
        $this->redirect("index.php?page=home");
    }

    
}