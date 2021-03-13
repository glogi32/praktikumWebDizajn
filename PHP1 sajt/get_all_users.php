<?php

header("Content-Type: application/json");

require_once "konekcija.php";

try{
$users = executeQuery("SELECT * FROM korisnici k INNER JOIN uloge u ON k.uloga_id=u.uloga_id");
echo json_encode($users);
}catch(PDOException $ex){
    echo "ERROR!!!";
    echo $ex-getMesage();
}