<?php $title = "Affichage d'un billet"; ?>

<?php ob_start(); ?>

<h1><?= htmlspecialchars($post->getTitle()) ?></h1>

<p><?= nl2br(htmlspecialchars($post->getContent())) ?></p>

<?php $content = ob_get_clean() ?>

<?php require 'layout.php' ?>