<?php
    session_start();
    header("Content-type: application/json");
    include "konekcija.php";

    if(isset($_POST['btnLogin'])){
		$email = $_POST['email'];
        $lozinka = md5($_POST['psw']);
        
        $erros = [];
        $reLozinka = "/^[a-z0-9\_-]{4,15}$/";
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "Email nije u dobrom formatu!";
        }

        if(!preg_match($reLozinka,$_POST['psw'])){
            $errors[] = "Lozinka nije u dobrom formatu!";
        }

        if(count($errors) > 0){
            $_SESSION['greske'] = $errors;
            var_dump($errors);
            json_encode($errors);
        }  else
        {
            include "konekcija.php";
            $upit = "SELECT * FROM korisnici WHERE email = :email AND sifra =:sifra";

            $priprema = $konekcija->prepare($upit);
            $priprema->bindParam(':email', $email);
            $priprema->bindParam(':sifra', $lozinka);

            $rezultat = $priprema->execute();
            if($rezultat){

                if($priprema->rowCount()==1){
                    $korisnik = $priprema->fetch();
                    $_SESSION["korisnik_id"] = $korisnik->id;
                    $_SESSION['korisnik'] = $korisnik;

                    if($_SESSION['korisnik']->uloga_id == 1){
                        header("Location: index.php?uloga=admin");
                    } elseif($_SESSION['korisnik']->uloga_id == 2) {
                        header("Location: index.php?uloga=korisnik");
                    } elseif($_SESSION['korisnik']->uloga_id == 3){
                        header("Location: index.php?uloga=prodavac");
                    }

                
                } else {
                    
                    if($priprema->rowCount() == 0) {

                        echo "<br/> NISTE REGISTROVANI!!";
                        http_response_code(401);
                    }
                }
            } else {
                
                echo "Upit nije dobar";
                http_response_code(500);
            }
        }
    }
?>