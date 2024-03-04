<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/load.php';
use Damero\Game;

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: errors/not-found.php");
    exit;
}
$game = Game::find($id);
if ($game) {
    $game->delete();
    header("Location: partides.php");
    exit();
} else{
    header("Location: errors/not-found.php");
    exit();
}
