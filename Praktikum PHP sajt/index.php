<?php

    require_once "config/connection.php";
    include "models/login_check.php";
    include "views/fixed/head.php";
    include "views/partials/forms.php";
    include "views/fixed/header.php";
    
    if(isset($_GET["stranica"])){
        switch($_GET["stranica"]){
            case "pocetna":
                include "views/pages/pocetna.php";
                break;
            case "admin":
                include "views/pages/admin.php";
                break;
            case "details":
                include "views/pages/details.php";
                break;
            case "oAutoru":
                include "views/pages/oAutoru.php";
                break;
            default:
                echo "<h1>404 Pages not Found</h1>";
                break;
        } 
    } else {
        include "views/pages/pocetna.php";
    }
    include "views/fixed/banner.php";
    include "views/fixed/footer.php";
    ?>