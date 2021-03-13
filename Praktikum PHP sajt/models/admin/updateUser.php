<?php



header('Content-Type: application/json');

if(isset($_POST['id']) && isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['email']) && isset($_POST['sifra']) && isset($_POST['uloga_id'])){
    include "../../config/connection.php";

    $id = $_POST['id'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $sifra = md5($_POST['sifra']);
    $uloga = $_POST['uloga_id'];
    $rezultat = $conn->prepare("UPDATE korisnici SET ime = ?,prezime = ?,email = ?,sifra = ?,uloga_id = ? WHERE korisnik_id = ?");

    $rezultat->bindValue(1,$ime);
    $rezultat->bindValue(2,$prezime);
    $rezultat->bindValue(3,$email);
    $rezultat->bindValue(4,$sifra);
    $rezultat->bindValue(5,$uloga);
    $rezultat->bindValue(6,$id);
   
    

    

    try {
        $rezultat->execute();
        http_response_code(204); // 204 - Success and No content (Nothing to return)
    }
    catch(PDOException $ex){
        zabeleziGresku($ex);
        echo json_encode(['poruka'=> 'Problem sa bazom: ' . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    http_response_code(400); // 400 - Bad request
}