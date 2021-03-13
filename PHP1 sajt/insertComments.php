<?php



if(isset($_POST["idKorisnika"]) && isset($_POST["tekst"]) && isset($_POST["idProizvoda"])){
    require_once 'konekcija.php';

    $idKorisnika = $_POST['idKorisnika'];
    $tekst = $_POST['tekst'];
    $vreme = time();
    $idProizvoda = $_POST["idProizvoda"];
    $rezultat = $konekcija->prepare("INSERT INTO komentari VALUES (NULL, ?,?,?,?)");

    try {
       
        
        $rezultat->execute( [ $tekst,$vreme,$idKorisnika,$idProizvoda ] );

        http_response_code(201); // 201 - Created

        
        
    }
    catch(PDOException $ex){
        echo $ex->getMessage();
        http_response_code(500);
    }
} else {
    http_response_code(400); // 400 - Bad request
}