<?php

header("Content-Type: application/json");

if(isset($_GET["id"])){
    require_once "konekcija.php";

    $id = $_GET["id"];

    $rez = $konekcija->prepare("SELECT * FROM korisnici k INNER JOIN uloge u ON k.uloga_id=u.uloga_id WHERE korisnik_id = ?");

    $rez->bindValue(1,$id);

    try{
        $rez->execute();
        $user = $rez->fetch();
        echo json_encode($user);
    }
    catch(PDOExeption $ex)
    {
        http_response_code(500);
    }
}else{
    http_response_code(400);
}