<?php $title = "Affichage d'un billet"; ?>

<?php ob_start(); ?>

<h1><?= htmlspecialchars($post->getTitle()) ?></h1>

<?php if (isset($_SESSION['pseudonym'])): ?>
    <a href="">Modifier</a>
    <a href="">Supprimer</a>
<?php endif; ?>

<p><?= nl2br(htmlspecialchars($post->getContent())) ?></p>

<?php $content = ob_get_clean() ?>

<?php require 'layout.php' ?>