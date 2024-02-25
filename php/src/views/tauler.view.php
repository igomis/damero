<?php
    /** @var \Damero\Partida $partida */
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
<div class="container">

    <div class="informacio-joc">
        <div id="jugadorActual"
             class="fitxa <?= $partida->getTorn() == 'jugador1' ? 'fitxa-jugador1' : 'fitxa-jugador2' ?>">
        </div>
    </div>
    <div class="informacio-joc">
        <div id="missatgeError">
            <?= isset($missatge) ? $missatge : '' ?>
        </div>
        <div id="missatgePartida">
            <?= $partida->getEstatJoc() ?>
        </div>
    </div>


    <div class="taula-de-dames">
        <?= $partida->getTauler() ?>
    </div>
</div>
<a href="reset.php">Nova Partida</a>
<form id="movimentForm" action="index.php" method="POST" style="display:none;">
    <input type="hidden" name="origenFila" id="origenFila">
    <input type="hidden" name="origenColumna" id="origenColumna">
    <input type="hidden" name="destinoFila" id="destinoFila">
    <input type="hidden" name="destinoColumna" id="destinoColumna">
</form>
<script src="../javascript/moviment.js"></script>
</body>
</html>
