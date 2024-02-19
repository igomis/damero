<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/Tauler.php';
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taula de Dames</title>
    <link rel="stylesheet" href="../css/damero.css">
</head>
<body>
    <?php
        $tauler = new Tauler();
        echo $tauler->generarHTML();
    ?>
</body>
</html>
