<?php

$word_app = new COM("Word.Application");
$word_app->Visible = true;

$word_app->Documents->Add();
$word_app->Selection->TypeText("Ime: Nemanja\n Prezime: Glogovac \n Broj indeksa: 293/18");

