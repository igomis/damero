<footer>
    <a href="reset.php">Nova Partida</a>
    <?php if (($userId) && ($partida->getEstatJoc() == 'acabat')): ?>
        <a href="guardaPartida.php">Guarda Partida</a>
    <?php endif; ?>
</footer>

