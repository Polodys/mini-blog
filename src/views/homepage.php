<?php $title = "Mon mini blog - Accueil"; ?>

<?php ob_start(); ?>

<h1>Liste des articles</h1>
<hr>

<p>Cliquez sur un titre pour afficher l'article en entier</p>
<hr>

<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <a href=""><?= htmlspecialchars($post->getTitle()) ?></a>
        </li>
    <?php endforeach ?>
</ul>

<?php $content = ob_get_clean(); ?>

<?php require 'layout.php' ?>