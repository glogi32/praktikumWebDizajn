<?php
    session_start();
    
    include "../config/connection.php";

    

    if(isset($_POST['btnLogin'])){
		$email = $_POST['email'];
        $lozinka = md5($_POST['psw']);
        
        $errors = [];
        $reLozinka = "/^[a-z0-9\_-]{4,15}$/";
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "Email nije u dobrom formatu!";
        }

        if(!preg_match($reLozinka,$_POST['psw'])){
            $errors[] = "Lozinka nije u dobrom formatu!";
        }

        if(count($errors) > 0){
            $_SESSION['greske'] = $errors;

            foreach ($errors as $key => $er) {
                echo "<script>alert('".$er."')</script>";
            }
            header("Location: ../index.php");
            
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
                    $_SESSION["korisnik_id"] = $korisnik->korisnik_id;
                    $_SESSION['korisnik'] = $korisnik;

                   

                    if($_SESSION['korisnik']->uloga_id == 1){
                        header("Location: ../index.php?stranica=admin&uloga=admin");
                    } elseif($_SESSION['korisnik']->uloga_id == 2) {
                        header("Location: ../index.php?uloga=korisnik");
                    } elseif($_SESSION['korisnik']->uloga_id == 3){
                        header("Location: ../index.php?uloga=prodavac");
                    }
                
                } else {



                    $_SESSION['greske'] = ["Pogresan email ili lozinka"];
                    http_response_code(422);
                    header("Location: ../index.php");




                }
            } else {
                
                echo "Greska na serveru, pokusajte kasnije!";
                http_response_code(500);
                header("Location: ../index.php");

            }
        }
    }
?>