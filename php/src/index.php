<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/Casella.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/Tauler.php';

$tauler = new Tauler();
if ($tauler->moureFitxa(2, 1, 3, 0)) {
    echo "Moviment realitzat amb èxit!";
} else {
    echo "Moviment invàlid.";
}
include_once './views/tauler.view.php';



