<header>
    <?php if ($userId): ?>
        <p>User: <?= $userId ?> <a href="logout.php">Logout</a></p>

    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</header>
