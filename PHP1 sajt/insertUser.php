<?php


header('Content-Type: application/json');

if(isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['email']) && isset($_POST['sifra']) && isset($_POST['uloga_id'])){
    require_once 'konekcija.php';

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $sifra = md5($_POST['sifra']);
    $uloga = $_POST['uloga_id'];
    $rezultat = $konekcija->prepare("INSERT INTO korisnici VALUES (NULL, ?,?,?,?,?)");

    try {
       
        
        $rezultat->execute( [ $ime,$prezime,$email,$sifra,$uloga ] );

        http_response_code(201); // 201 - Created

        
        echo json_encode(["uspeh"=> "Uspesno kreirana kategorija!"]);
    }
    catch(PDOException $ex){
        echo json_encode(['poruka'=> 'Problem sa bazom: ' . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    http_response_code(400); // 400 - Bad request
}