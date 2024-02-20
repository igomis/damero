<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/load.php';


$datos = $_POST;
// Leer el cuerpo de la petición

/** @var \Damero\Partida $partida */
$partida->moureFitxa($datos['origenFila'],$datos['origenColumna'],$datos['destinoFila'],$datos['destinoColumna']);
header('Location:index.php');

