<?php 

if(isset($_POST["p_name"]) && isset($_POST["price"]) && isset($_POST["screen"]) && 
isset($_POST["processor"]) && isset($_POST["camera"]) && isset($_POST["ram"])
  && isset($_POST["ddlType"]) && isset($_POST["ddlBrands"])){
    
    include "../config/connection.php";

    $name = $_POST["p_name"];
    $price = $_POST["price"];
    $screen = $_POST["screen"];
    $processor = $_POST["processor"];
    $camera = $_POST["camera"];
    $ram = $_POST["ram"];
    $brand = $_POST["ddlBrands"];
    $tipProizvoda = $_POST["ddlType"];
    $slika = $_FILES["image"];
    $slikaIme = time()."_".$slika["name"];
    $slikaSize = $slika["size"];
    $slikaTip = $slika["type"];
    $slikaTmp = $slika["tmp_name"];
    $slikaAlt = $name;
    $vreme = time();

    $errors = [];
    
    $moveFromTmp = "../assets/img/products_img/".$slikaIme;
    $novaPutanja = "assets/img/products_img/".$slikaIme;
    
    $dozvoljeniFormati = ["image/jpg", "image/jpeg", "image/png", "image/gif"];
    $reName = "/^[a-zA-Z0-9\s]{3,24}$/";
    
    if(!in_array($slikaTip,$dozvoljeniFormati)){
        array_push($errors,"Slika nije u dozvoljenom formatu!");
    }

    if($slikaSize > 6000000){
        array_push($errors,"Slika ne sme bit veca od 6MB!");
    }

    if(!preg_match($reName,$name)){
        array_push($errors,"Ime proizvoda ne sme biti vece od 24 karaktera i manje od 3");
    }

    if($tipProizvoda == 0){
        array_push($errors,"Morate izabrati tip proizvoda");
    }

    if($brand == 0){
        array_push($errors,"Morate izabrati proizvodjaca");
    }

    if(count($errors) == 0){


        $uspesanUpload = move_uploaded_file($slikaTmp,$moveFromTmp);
        
        if($uspesanUpload){
            $rezultat = $conn->prepare("INSERT INTO proizvodi VALUES(NULL,?,?,?,?,?,?,?,?)");
            try{
                $rezultat1 = $rezultat->execute([$name,$price,$screen,$processor,$camera,$ram,$tipProizvoda,$brand]);
            
            }
            catch(PDOException $ex){
                echo $ex->getMessage();
            }

            $last_id = $conn->lastInsertId();

            $rezultat = $conn->prepare("INSERT INTO slike VALUES(NULL,?,?,?,?)");

            try{
                $rezultat2 = $rezultat->execute([$name,$novaPutanja,$last_id,$vreme]);
            }catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }

            if($rezultat1 && $rezultat2){
                header("Location: ../index.php");
                echo "USPESAN UPDATE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
            }
        }else{
            echo "Upload slike FAIL!!!!";
        }

    }else{
        echo "<ul>";
        foreach($errors as $error){
            echo "<li>".$error."</li>";
        }
        echo "</ul>";
    }

  
    
}else{
    echo "Nisu svi podaci uneti";
    http_response_code(422);
    header("Location:index.php");
}