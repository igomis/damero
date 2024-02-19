<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/load.php';

/** @var TYPE_NAME $tauler */
if ($tauler->moureFitxa(3, 2, 4, 1)) {
    echo "Moviment realitzat amb èxit!";
} else {
    echo "Moviment invàlid.";
}
include_once './views/tauler.view.php';



