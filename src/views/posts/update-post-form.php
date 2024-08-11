<?php $title = "Modification d'un billet"; ?>

<?php ob_start(); ?>

<h1>Modification du billet</h1>

<form action="index.php?action=update-post&id=<?= htmlspecialchars($post->getId()) ?>" method="post">
    <label for="title">Titre :</label>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($post->getTitle()) ?>" required>
    
    <label for="content">Article :</label>
    <textarea name="content" id="content" required><?= nl2br(htmlspecialchars($post->getContent())) ?></textarea>
    
    <button type="submit">Mettre à jour</button>
</form>

<?php $content = ob_get_clean() ?>

<?php require 'src/views/layout.php' ?>
