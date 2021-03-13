<?php

function get_all_product_types(){
    return executeQuery("SELECT *,t.naziv AS tip_naziv,COUNT(*) AS BROJ_UREDJAJA FROM tip t INNER JOIN proizvodi p ON t.tip_id=p.tip_id GROUP BY t.naziv ");
}

function get_all_product_brands(){
    return executeQuery("SELECT pr.proizvodjac_id AS proizvodjac_id,pr.naziv AS naziv,COUNT(*) AS brojProizvoda FROM proizvodi p INNER JOIN proizvodjaci pr ON pr.proizvodjac_id=p.proizvodjac_id GROUP BY pr.naziv");
}

function get_all_products_by_brand($id_brand){
    global $conn;
    $select = $conn->prepare("SELECT * FROM proizvodi p INNER JOIN slike s ON p.proizvod_id = s.proizvod_id  WHERE p.proizvod_id = ?");
    $select->execute([$id_brand]);
    return $select->fetch();
}