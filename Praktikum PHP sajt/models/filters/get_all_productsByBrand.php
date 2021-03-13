<?php

header("Content-Type: application/json");


if(isset($_GET["id"])){
    $id = $_GET["id"];
    include "../../config/connection.php";
    $priprema = $conn->prepare("SELECT AVG(ocena) AS prosek,p.*, s.src AS src, s.alt AS alt FROM ocene o RIGHT OUTER JOIN proizvodi p ON o.proizvod_id=p.proizvod_id
    INNER JOIN slike s ON p.proizvod_id=s.proizvod_id WHERE p.proizvodjac_id = ? GROUP BY p.proizvod_id LIMIT 0,6");
    try{
        $rez = $priprema->execute([$id]);
        
        $rez = $priprema->fetchAll();
        if(count($rez) == 0){
            http_response_code(500);
        }
        echo json_encode($rez);
    }catch(PDOException $ex){
        zabeleziGresku($ex);
        echo "ERROR!!!";
        echo $ex-getMesage();
        http_response_code(500);
    }
}else{
    http_response_code(400);
}
