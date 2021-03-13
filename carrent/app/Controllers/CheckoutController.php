<?php

namespace app\Controllers;
use app\models\Database;
use app\models\Cars;

class CheckoutController extends Controller{

    private $carsModel;

    public function __construct()
    {
        $this->carsModel = new Cars(Database::instance());
    }

    public function checkoutPage(){
        $this->loadView("checkout");
    }

    public function insertRezervation(){

        
        
        if(isset($_POST['btnSubmitRez'])){
            $errorsId = "";
            $errors = [];
            if($_POST['hiddenIdK']){
                if($_POST['hiddenIdC']){
                    $pickupA = $_POST['pickupA'];
                    $dropOffA = $_POST['dropoffA'];
                    $fromDate = strtotime($_POST['fromD']);
                    $toDate = strtotime ($_POST['toD']);
                    $idC = $_POST['hiddenIdC'];
                    $idK = $_POST['hiddenIdK'];
                    $now = strtotime("now");
                    
                    
                    $reAddress = '/^[\w\s\/\\-_]{4,24}$/';
                    
                    if(!$pickupA){
                        array_push($errors,"Polje za pick up adresu je obavezno!");
                    }
                    elseif(!preg_match($reAddress,$pickupA)){
                        array_push($errors,"Pick up adresa nije u dobrom formatu!");
                    }
                    if(!$dropOffA){
                        array_push($errors,"Polje za drop off adresu je obavezno!");
                    }
                    elseif(!preg_match($reAddress,$dropOffA)){
                        array_push($errors,"Pick up adresa nije u dobrom formatu!");
                    }
                    if($toDate <= $fromDate){
                        array_push($errors,"Pocetni datum mora biti stariji od krajnjeg datuma!");
                    }
                    if($fromDate < $now){
                        array_push($errors,"Pocetni datum ne moze biti datum iz proslosti!");
                    }

                    if(count($errors) == 0){
                        
                        $insert = $this->carsModel->insertRezervation($pickupA,$dropOffA,$fromDate,$toDate,$idK,$idC);

                        if($insert){
                            $_SESSION['checkout_id_errors'] = "Uspesno ste izvrsili rezervaciju!";
                            $this->redirect($_SERVER['HTTP_REFERER']);
                        }
                        else{
                            $_SESSION['checkout_id_errors'] = "Greska na serveru, pokusajte kasnije!";
                            $this->redirect($_SERVER['HTTP_REFERER']);
                        }

                    }else{
                        $_SESSION["checkout_errors"] = $errors;
                        $this->redirect($_SERVER['HTTP_REFERER']);
                    }


                }
                else{
                    $errorsId = "Niste izabrali automobil!";
                    $_SESSION["checkout_id_errors"] = $errorsId;
                    $this->redirect($_SERVER['HTTP_REFERER']);
                }
            }else{
                $errorsId = "Morate biti ulogovani da biste mogli da rezervisete automobil!";
                $_SESSION["checkout_id_errors"] = $errorsId;
                $this->redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function getAllReservations(){
        if(isset($_SESSION['user'])){
            $rez = $this->carsModel->getAllReservationsById($_SESSION['user']->korisnik_id);
            if($rez){
                $this->json($rez,200);
            }else{
                $this->json(404);
            }
        }else{
            $this->json(500);
        }
    }

    public function deleteRezervation(){
        if(isset($_POST['id'])){
            $r = $this->carsModel->deleteRezervation($_POST['id']);
            if($r){
                $this->json(204);
            }
            else{
                $this->json(404);
            }
        }else{
            $this->json(500);
        }
    }
}