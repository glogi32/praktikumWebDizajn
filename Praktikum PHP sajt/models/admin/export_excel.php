<?php

require_once "../../config/connection.php";
include "functions.php";

$products = get_all_products();


$excel = new COM("Excel.Application");


$excel->Visible = 1;


$excel->DisplayAlerts = 1;


$workbook = $excel->Workbooks->Add();


$sheet = $workbook->Worksheets('Sheet1');
$sheet->activate;

    $polje = $sheet->Range("A1");
    $polje->activate;
    $polje->value = "RB";

    $polje = $sheet->Range("B1");
    $polje->activate;
    $polje->value = "Naziv";

    $polje = $sheet->Range("C1");
    $polje->activate;
    $polje->value = "Cena";

    $polje = $sheet->Range("D1");
    $polje->activate;
    $polje->value = "Ekran";

    $polje = $sheet->Range("E1");
    $polje->activate;
    $polje->value = "Procesor";

    $polje = $sheet->Range("F1");
    $polje->activate;
    $polje->value = "Kamera";

    $polje = $sheet->Range("G1");
    $polje->activate;
    $polje->value = "Ram";

$br = 2;
foreach($products as $p){
    
    $polje = $sheet->Range("A{$br}");
    $polje->activate;
    $polje->value = $br;

    $polje = $sheet->Range("B{$br}");
    $polje->activate;
    $polje->value = $p->naziv;

    $polje = $sheet->Range("C{$br}");
    $polje->activate;
    $polje->value = $p->cena;

    $polje = $sheet->Range("D{$br}");
    $polje->activate;
    $polje->value = $p->ekran;

    $polje = $sheet->Range("E{$br}");
    $polje->activate;
    $polje->value = $p->procesor;

    $polje = $sheet->Range("F{$br}");
    $polje->activate;
    $polje->value = $p->kamera;

    $polje = $sheet->Range("G{$br}");
    $polje->activate;
    $polje->value = $p->ram;

    $br++;
}


$workbook->_SaveAs(ABSOLUTE_PATH."/models/admin/Products.xlsx", -4143);
$workbook->Save();


$workbook->Saved=true;
$workbook->Close;

$excel->Workbooks->Close();
$excel->Quit();

