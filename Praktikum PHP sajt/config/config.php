<?php

define("ABSOLUTE_PATH",$_SERVER['DOCUMENT_ROOT']."/Praktikum PHP sajt");

define("ENV_FAJL",ABSOLUTE_PATH."/config/.env");
define("LOG_FAJL",ABSOLUTE_PATH."/data/log.txt");
define("GRESKE_FAJL",ABSOLUTE_PATH."/data/greske.txt");

define("SERVER",env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME",env("USERNAME"));
define("PASSWORD",env("PASSWORD"));

function env($naziv){
    $podaci = file(ENV_FAJL);
    $vrednost = "";
    foreach($podaci as $key=>$value){
        $konfig = explode("=",$value);
        if($konfig[0] == $naziv){
            $vrednost = trim($konfig[1]);
        }
    }
    return $vrednost;
}

function zabeleziPristupStranici(){
    $open = fopen(LOG_FAJL, "a");
    if($open){
        $date = date('d-m-Y H:i:s');
        if(isset($_GET['stranica'])){
            $stranica = $_GET['stranica'];
        }
        else{
            $stranica = "null";
        }
        fwrite($open, "{$_SERVER['PHP_SELF']}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\t{$stranica}\n");
        fclose($open);
    }
}

function zabeleziGresku($greska){
    $open = fopen(GRESKE_FAJL, "a");
    if($open){
        $date = date('d-m-Y H:i:s');
        
        fwrite($open, "{$_SERVER['PHP_SELF']}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\t{$greska}\n");
        fclose($open);
    }
}

