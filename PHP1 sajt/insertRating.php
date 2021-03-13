<?php



if(isset($_GET["idProizvoda"]) && isset($_GET["rating"])){
    require_once 'konekcija.php';

    
    $rating = $_GET['rating'];
    $vreme = time();
    $idProizvoda = $_GET["idProizvoda"];
    $rezultat = $konekcija->prepare("INSERT INTO ocene VALUES (NULL, ?,?,?)");

    try {
       
        
        $rezultat->execute( [ $rating,$idProizvoda,$vreme ] );

        http_response_code(201); // 201 - Created

        
        
    }
    catch(PDOException $ex){
        echo $ex->getMessage();
        http_response_code(500);
    }
} else {
    http_response_code(400); // 400 - Bad request
}