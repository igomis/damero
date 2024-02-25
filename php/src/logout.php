<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/load.php';
use BatBook\User;

User::logout();
header("Location: index.php");
