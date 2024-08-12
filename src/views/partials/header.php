<header>
    <nav>
        <a href="index.php">Mon mini blog</a>
        <ul>
            <li>
                <a href="index.php">Accueil</a>
            </li>

            <?php if (isset($_SESSION['authorPseudonym'])): ?>
                <li>
                    <a href="index.php?action=create-post-form">Nouvel article</a>
                </li>
                <li>Bienvenue <?= htmlspecialchars($_SESSION['authorPseudonym']) ?></li>
                <li>
                    <a href="index.php?action=logout">Déconnexion</a>
                </li>
            <?php else: ?>
                <li>
                    <a href="index.php?action=login">Connexion</a>
                </li>
                <li>
                    <a href="index.php?action=register">Inscription</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>