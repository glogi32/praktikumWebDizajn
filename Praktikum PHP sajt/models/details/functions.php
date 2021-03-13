<?php

function get_single_product($id_product){
    global $conn;
    $select = $conn->prepare("SELECT * FROM proizvodi p INNER JOIN slike s ON p.proizvod_id = s.proizvod_id  WHERE p.proizvod_id = ?");
    $select->execute([$id_product]);
    return $select->fetch();
}



function get_all_comments_products($idProizvoda){
    global $conn;
    $select = $conn->prepare("SELECT tekst,ime,prezime,vreme FROM komentari k INNER JOIN proizvodi p ON k.proizvod_id = p.proizvod_id INNER JOIN korisnici kr ON k.korisnik_id = kr.korisnik_id WHERE k.proizvod_id = ?");
    $select->execute([$idProizvoda]);
    return $select->fetchAll();
}