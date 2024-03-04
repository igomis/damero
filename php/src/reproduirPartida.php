<?php

use Damero\QueryBuilder;
use Damero\Moviment;
use Damero\Tauler;

require_once $_SERVER['DOCUMENT_ROOT'].'/load.php';

/** @var \Damero\Partida $partida */

$idPartida = $_GET['id'];
$moviments = QueryBuilder::sql(Moviment::class, ['idPartida' => $idPartida]);
$tauler = new Tauler();
foreach ($moviments as $moviment) {
    $tauler->
    sleep(1);
    $tauler->moure($moviment->getOrigenFila(), $moviment->getOrigenColumna(), $moviment->getDestiFila(), $moviment->getDestiColumna());
}



header('Location: /index.php');





