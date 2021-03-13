<?php

function get_first4_slider($id_brand){
    global $conn;
    $select = $conn->prepare("SELECT p.proizvod_id AS idProizvoda, src AS src, alt AS alt, p.naziv AS nazivTel FROM proizvodi p INNER JOIN proizvodjaci pr ON p.proizvodjac_id = pr.proizvodjac_id INNER JOIN slike s ON p.proizvod_id = s.proizvod_id WHERE pr.naziv = ? LIMIT 0,4");
    $select->execute([$id_brand]);
    return $select->fetchAll();
}

function get_products_sale(){
    return executeQuery("SELECT * FROM proizvodi p INNER JOIN slike s ON p.proizvod_id=s.proizvod_id ORDER BY cena DESC LIMIT 0,2");
}