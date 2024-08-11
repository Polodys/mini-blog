<?php $title = "Affichage d'un billet"; ?>

<?php ob_start(); ?>

<h1><?= htmlspecialchars($post->getTitle()) ?></h1>

<?php if (isset($_SESSION['pseudonym']) && (int) $_SESSION['author_id'] === (int) $post->getAuthorId()): ?>
    <a href="index.php?action=update-post-form&id=<?= htmlspecialchars($post->getId()); ?>">Modifier</a>
    <a href="index.php?action=delete-post&id=<?= htmlspecialchars($post->getId()); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce billet ?');">Supprimer</a>
<?php endif; ?>

<p><?= nl2br(htmlspecialchars($post->getContent())) ?></p>

<?php $content = ob_get_clean() ?>

<?php require 'src/views/layout.php' ?>