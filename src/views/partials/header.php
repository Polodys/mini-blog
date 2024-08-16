<header class="bg-dark text-white py-3 mb-4">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg" data-bs-theme="dark">
            <a class="navbar-brand mx-5" href="index.php">Mon mini blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end text-end" id="navbarToggler">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>

                    <?php if (isset($_SESSION['authorPseudonym'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=create-post-form">Nouvel article</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['authorPseudonym'])): ?>
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link disabled" aria-disabled="true">Bienvenue <?= htmlspecialchars($_SESSION['authorPseudonym']) ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=logout">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=login">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=register">Inscription</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
</header>