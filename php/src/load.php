<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/../vendor/autoload.php';

use Damero\Partida;

session_start();
if (isset($_SESSION['partida'])){
    $partida = unserialize($_SESSION['partida']);
} else {
    $partida = new Partida();
    $_SESSION['partida'] = serialize($partida);
}

