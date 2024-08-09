<header>
    <nav>
        <a href="index.php">Mon mini blog</a>
        <ul>
            <li>
                <a href="index.php">Accueil</a>
            </li>
            <li>
                <a href="index.php?action=create-post-form">Nouvel article</a>
            </li>
            <?php if (isset($_SESSION['username'])): ?>
                <li>Bienvenue <?= htmlspecialchars($_SESSION['username']) ?></li>
                <li><a href="index.php?action=logout">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="index.php?action=login">Connexion</a></li>
                <li><a href="index.php?action=register">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>