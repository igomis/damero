<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/load.php';

/** @var \Damero\Partida $partida */

$partida->desarMoviments();
header('Location: /index.php');





