<?php
    
    global $conn;
    session_start();
    $errors = [];
    if(isset($_POST['btnLogin'])){
		$email = $_POST['email'];
        $lozinka = md5($_POST['psw']);
        
        
        $reLozinka = "/^[a-z0-9\_-]{4,15}$/";
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "Email nije u dobrom formatu!";
        }

        if(!preg_match($reLozinka,$_POST['psw'])){
            $errors[] = "Lozinka nije u dobrom formatu!";
        }

        if(count($errors) > 0){
            $_SESSION['greske'] = $errors;
        }  else
        {

            $upit = "SELECT * FROM korisnici WHERE email = :email AND sifra =:sifra";

            $priprema = $conn->prepare($upit);
            $priprema->bindParam(':email', $email);
            $priprema->bindParam(':sifra', $lozinka);

            $rezultat = $priprema->execute();
            if($rezultat){
                if($priprema->rowCount()==1){
                    
                    $korisnik = $priprema->fetch();
                    $_SESSION['korisnik_id'] = $korisnik->korisnik_id;
                    $_SESSION['korisnik'] = $korisnik;

                    if($_SESSION['korisnik']->uloga_id == 1){
                        header("Location: index.php?stranica=admin");
                    } elseif($_SESSION['korisnik']->uloga_id == 2) {
                        header("Location: index.php?stranica=pocetna");
                    } elseif($_SESSION['korisnik']->uloga_id == 3){
                        header("Location: index.php?stranica=pocetna");
                    }
                
                } else {
                    
                    
                    if($priprema->rowCount() == 0){
                        echo "<script>alert('NISTE REGISTROVANI!!')</script>";
                        http_response_code(401);
                    }
                }
            } else {
                echo "<script>alert('Greska na serveru!!')</script>";
                http_response_code(500);
            }
        }
    }
    
?>