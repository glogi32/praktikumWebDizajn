<?php

function get_all_products(){
    return executeQuery("SELECT * FROM proizvodi");
}