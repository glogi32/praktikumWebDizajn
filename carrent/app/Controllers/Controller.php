<?php

namespace app\Controllers;


class Controller{

    

    protected function loadView($view, $data = null){
        $data;
        require_once "app/views/fixed/header.php";
        require_once "app/views/".$view.".php";
        require_once "app/views/fixed/footer.php";
    }

    protected function redirect($page) {
        header("Location: " . $page);
    }

    protected function json($data = null, $statusCode = 200) {
        header("Content-Type: application/json");
        echo json_encode($data);
        http_response_code($statusCode);
    }

}
