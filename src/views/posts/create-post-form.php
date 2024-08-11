<?php $title = "Mon mini blog - Création d'un nouveau billet"; ?>

<?php ob_start(); ?>

<h1>Création d'un nouveau billet</h1>

<?php if (isset($errorMessage)): ?>
    <p style="color: red"><?= htmlspecialchars($errorMessage) ?></p>
<?php endif; ?>

<form action="index.php?action=create-post" method="post">
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title" required>

    <label for="content">Article :</label>
    <textarea id="content" name="content" required></textarea>

    <button type="submit">Créer le billet</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require 'src/views/layout.php'; ?>