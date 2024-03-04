<?php
session_start();
unset($_SESSION['userId']);
unset($_SESSION['partida']);


header("Location: index.php");
