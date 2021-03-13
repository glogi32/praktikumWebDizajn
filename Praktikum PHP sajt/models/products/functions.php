<?php

function get_all_products_by_page($page){
    global $conn;
    $select = $conn->prepare("SELECT AVG(ocena) AS prosek,p.*, s.src AS src, s.alt AS alt FROM ocene o RIGHT OUTER JOIN proizvodi p ON o.proizvod_id=p.proizvod_id
    INNER JOIN slike s ON p.proizvod_id=s.proizvod_id GROUP BY p.proizvod_id LIMIT :page,6");
    $select->bindParam(':page', $page, PDO::PARAM_INT);
    $select->execute();
    return $select->fetchAll();
}

function get_num_of_products(){
    
    return executeQuery("SELECT COUNT(*) AS brojProizvoda FROM proizvodi");
}

function get_num_of_links(){

    $brojProizvoda = get_num_of_products();
    
    $brojProizvodaINT = intval($brojProizvoda[0]->brojProizvoda);
    
    $brojLinkova = ceil($brojProizvodaINT / 6);
   
    return $brojLinkova;
}