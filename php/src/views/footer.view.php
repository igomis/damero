<footer>
    <a href="reset.php">Nova Partida</a>
    <?php if (($userId) && ($partida->getEstatJoc() == 'acabat')): ?>
        <a href="guardaPartida.php">Guarda Partida</a>
        <a href="recuperarPartida.php">Recuperar Partida</a>
    <?php endif; ?>
    <a href="reproduirPartida.php">Reproduir Partida</a>
</footer>

