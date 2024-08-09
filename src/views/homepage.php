<?php $title = "Mon mini blog - Accueil"; ?>

<?php ob_start(); ?>

<h1>Liste des articles</h1>
<hr>

<p>Cliquez sur un titre pour afficher l'article en entier</p>
<hr>

<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <a href="index.php?action=show-one-post&id=<?= htmlspecialchars($post->getId()); ?>"><?= htmlspecialchars($post->getTitle()) ?></a> <!-- Using htmlspecialchars for the id is a priori superfluous, because it's normally an integer from the database ; but I've chosen to systematically process all dynamic datas in this app --> 
        </li>
    <?php endforeach ?>
</ul>

<?php $content = ob_get_clean(); ?>

<?php require 'layout.php' ?>