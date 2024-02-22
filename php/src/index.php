<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/load.php';

/** @var \Damero\Partida $partida */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = $_POST;
    $missatge = $partida->moureFitxa(
            $datos['origenFila'],
            $datos['origenColumna'],
            $datos['destinoFila'],
            $datos['destinoColumna']);
}
include_once './views/tauler.view.php';





