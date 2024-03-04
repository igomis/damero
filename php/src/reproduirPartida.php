<?php


require_once $_SERVER['DOCUMENT_ROOT'].'/load.php';

/** @var \Damero\Partida $partida */

$partida  = unserialize($_SESSION['partida']);
$moviment = $_SESSION['moviment'] ?? 0;

$movimentActual = $partida->getMoviment($moviment);
$missatge = $partida->moureFitxa(
    $movimentActual['origenFila'],
    ord($movimentActual['origenColumna']) - 64,
    $movimentActual['destiFila'],
    ord($movimentActual['destiColumna']) - 64
);
include_once './views/tauler.view.php';

$_SESSION['partida'] = serialize($partida);
$_SESSION['moviment'] = ++$moviment;







