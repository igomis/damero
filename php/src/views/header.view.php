<header>
    <?php if ($userId): ?>
        <p>User: <?= $userId ?> <a href="logout.php">Logout</a></p>
        <a href="partides.php">Partides</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</header>
