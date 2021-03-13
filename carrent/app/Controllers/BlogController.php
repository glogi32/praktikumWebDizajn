<?php

namespace app\Controllers;
use app\models\Database;
use app\models\Blog;

class BlogController extends Controller{

    private $blogModel;

    public function __construct()
    {
        $this->blogModel = new Blog(Database::instance());
    }

    public function blogPage(){

        $brojLinkova = $this->blogModel->getNumOfLinks();
        $page = 0;
        if(isset($_GET['pagePost'])){
            $page = ($_GET["pagePost"] -1) * 3;
            
        }

        $this->loadView("blog",["posts" => $this->blogModel->getAllByPage($page),"brojLinkova" => $brojLinkova]);
    }

    public function blogSinglePage(){
        if(isset($_GET['idP'])){
            $post = $this->blogModel->getSinglePost($_GET['idP']);
            $komentari = $this->blogModel->getAllCommentsForPost($_GET['idP']);
            $brojKomentara = $this->blogModel->getNumOfCom($_GET['idP']);
        }
        else{
            $this->redirect("index.php?page=blog");
        }
        $this->loadView("blogSingle",["post" => $post,"komentari" => $komentari,"broj_komentara" => $brojKomentara[0]]);
    }

    public function insertPost(){
        if(isset($_POST['btnAddPost'])){
            $title = $_POST['title'];
            $text = $_POST["textPost"];
            $idK = $_POST['tbHiddenP'];
            $slika = $_FILES['pimg'];
            $vremeObjave = time();
            $izabrani = $_POST['ddlFeaturedPost'];
            $niz = [];
            $errors = [];

            if($text != null){
                $expText = explode(".",$text);
                array_push($niz,$expText[0]);
                array_push($niz,$expText[1]);
                $skracenTekst = implode(".",$niz);
                $skracenTekst.= ".";
            }
            else{
                array_push($errors,"Morate imati sadrzaj posta!");
            }

            if($slika['name'] == null){
                array_push($errors,"Morate uneti sliku posta!");
            }

            $ime_fajla = time()."_".$slika["name"];
            $tip_fajla = $slika["type"];
            $velicina_fajla = $slika["size"];
            $tmp_name = $slika["tmp_name"];
            $alt = $slika['name'];
            $dozvoljeniFormati = ["image/jpg", "image/jpeg", "image/png", "image/gif"];

            $novaPutanja = "public/vendor/images/posts/".$ime_fajla;

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

                $insert = $this->blogModel->insertPost($title,$text,$skracenTekst,$novaPutanja,$alt,$vremeObjave,$idK,$izabrani);
                if($insert){
                    $_SESSION['insert_post'] = "Uspesan unos posta!";
                    $this->redirect("index.php?page=admin");
                } 
                else{
                    $_SESSION['insert_post'] = "Greska na serveru, pokusajte kasnije.";  
                    $this->redirect("index.php?page=admin");
                }
            }else{
                $_SESSION["errors_postInsert"] = $errors;
                $this->redirect("index.php?page=admin");
            }
            
        }else{
            $this->redirect("index.php?page=admin");
        }
    }

    public function insertComment(){
        if(isset($_POST['btnSubmitCom'])){
            $idK = $_POST['idK'];
            $message = $_POST['message'];
            $time = time();
            $idP = $_POST['idP'];
            
            $insert =$this->blogModel->insertComment($message,$time,$idK,$idP);

            if($insert){
                $_SESSION['insert_com'] = "Komentar uspesno poslat";
                $this->redirect($_SERVER["HTTP_REFERER"]);
            }else{
                $_SESSION['insert_com'] = "Greska pri upisu komntara!";
                $this->redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function findPost(){
        if(isset($_GET['tekst'])){
            $postovi = $this->blogModel->getPostsBySearch($_GET['tekst']);
            if($postovi){
                $this->json($postovi,200);
            }else{
                $this->json(404);
            }
        }else{
            $this->json(500);
        }
    }
   
}