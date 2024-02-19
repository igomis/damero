<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/../vendor/autoload.php';

use Damero\Tauler;

session_start();
if (isset($_SESSION['tauler'])){
    $tauler = unserialize($_SESSION['tauler']);
} else {
    $tauler = new Tauler();
    $_SESSION['tauler'] = serialize($tauler);
}

