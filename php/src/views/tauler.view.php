<?php
    $file = $_SERVER['DOCUMENT_ROOT'].'/javacript/moviment.js';
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
        echo $tauler->paint();
    ?>
    <script src="../javascript/moviment.js"></script>
</body>
</html>
