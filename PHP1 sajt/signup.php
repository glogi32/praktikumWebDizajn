<?php
    session_start();
    header("Content-type: application/json");
    include "konekcija.php";
    $code = 404;
    $data = null;

    if(isset($_POST["send"])){
        $ime = $_POST["ime"];
        $prezime = $_POST["prezime"];
        $email = $_POST["email"];
        $sifra = md5($_POST["sifra"]);

        $errors = [];

        $reIme = "/^[A-Z][a-z]{2,15}$/";
        $rePrezime = "/^[A-Z][a-z]{2,15}$/";
        $reSifra = "/^[a-z0-9\_-]{4,15}$/";

        if(!$ime){
            array_push($errors,"Polje za ime je obavezno!");
        }
        elseif(!preg_match($reIme,$ime)){
            array_push($errors,"Ime nije u dobrom formatu!");
        }

        if(!$prezime){
            array_push($errors,"Polje za prezime je obavezno!");
        }
        elseif(!preg_match($rePrezime,$prezime)){
            array_push($errors,"Prezime nije u dobrom formatu!");
        }

        if(!$_POST["sifra"]){
            array_push($errors,"Polje za lozinku je obavezno!");
        }
        elseif(!preg_match($reSifra,$_POST["sifra"])){
            array_push($errors,"Lozinka nije u dobrom formatu!");
        }

        if(!$email){
            array_push($errors,"Polje za email je obavezno!");
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors,"Email nije u dobrom formatu");
        };

        if(count($errors)){
            $code = 422;
            $data = $errors;
        } else{
            $upit = "INSERT INTO korisnici (korisnik_id, ime, prezime, email, sifra, uloga_id) VALUES (NULL,:ime,:prezime,:email,:sifra,2)";
            
            $statement = $konekcija->prepare($upit);
            $statement->bindParam(":ime",$ime);
            $statement->bindParam(":prezime",$prezime);
            $statement->bindParam(":email",$email);
            $statement->bindParam(":sifra",$sifra);
            
            try{
                $code = $statement->execute() ? 201 : 500;
            }catch(PDOExeption $e){
                $code = 409;
            }
        }
    }

    http_response_code($code);
    echo json_encode($data);