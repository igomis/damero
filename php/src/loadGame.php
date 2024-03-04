<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/load.php';
use Damero\Partida;

/** @var \Damero\Partida $partida */

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: errors/not-found.php");
    exit;
}

$partida = Partida::recuperarPartida($id);
$_SESSION['partida'] = serialize($partida);
$_SESSION['moviment'] = 0;
header('Location: /index.php');





