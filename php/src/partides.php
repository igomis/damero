<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/load.php';

use Damero\QueryBuilder;
use Damero\Game;
/** @var \Damero\Partida $partida */

$partides = QueryBuilder::sql(Game::class, ['idUser' => $_SESSION['userId']]);
include_once "./views/partidas/index.view.php";






