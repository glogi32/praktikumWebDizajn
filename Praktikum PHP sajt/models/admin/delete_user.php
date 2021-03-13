<?php

header("Content-Type: application/json");

if(isset($_GET["id"])){
    include "../../config/connection.php";

    $id = $_GET["id"];

    $rezultat = $conn->prepare("DELETE FROM korisnici WHERE korisnik_id = ?");
    $rezultat->bindValue(1, $id);

    try{
        $rezultat->execute();
        http_response_code(204);
    }
    catch(PDOExeption $ex){
        zabeleziGresku($ex);
        echo json_encode(['poruka'=> 'Problem sa bazom: ' . $ex->getMessage()]);
        http_response_code(500);
    }
}else{
    http_response_code(400);
}