<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/load.php';

/** @var \Damero\Partida $partida */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = $_POST;
    try {
        $partida->moureFitxa(
            $datos['origenFila'],
            $datos['origenColumna'],
            $datos['destinoFila'],
            $datos['destinoColumna']
        );
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
include_once './views/tauler.view.php';





