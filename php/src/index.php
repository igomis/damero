<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/load.php';

$error = $_SESSION['error']??null;
unset($_SESSION['error']);

include_once './views/tauler.view.php';




