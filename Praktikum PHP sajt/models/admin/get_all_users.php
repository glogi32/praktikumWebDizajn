<?php

header("Content-Type: application/json");

include "../../config/connection.php";

try{
$users = executeQuery("SELECT * FROM korisnici k INNER JOIN uloge u ON k.uloga_id=u.uloga_id");
echo json_encode($users);
}catch(PDOException $ex){
    zabeleziGresku($ex);
    echo "ERROR!!!";
    echo $ex-getMesage();
}