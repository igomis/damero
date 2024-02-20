<?php
    /** @var \Damero\Tauler $tauler */
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
    <div id="missatgeError" style="display: none; color: red; text-align: center; margin-bottom: 10px;">
        <?= isset($error)?$error:'' ?>
    </div>

    <?= $tauler ?>
    <a href="reset.php">Nova Partida</a>

    <form id="movimentForm" action="processarMoviment.php" method="POST" style="display:none;">
        <input type="hidden" name="origenFila" id="origenFila">
        <input type="hidden" name="origenColumna" id="origenColumna">
        <input type="hidden" name="destinoFila" id="destinoFila">
        <input type="hidden" name="destinoColumna" id="destinoColumna">
    </form>

    <script src="../javascript/moviment.js"></script>
</body>
</html>
