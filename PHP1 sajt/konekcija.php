<?php

try {
    $konekcija = new PDO("mysql:host=localhost;dbname=electronic_shop;charset=utf8","root","");
    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();
}

function executeQuery($query){
    global $konekcija;
    $rezultat = $konekcija->query($query)->fetchAll();
    return $rezultat;
}





































