<?php $title = "Inscription"; ?>

<?php ob_start(); ?>

<h1>Inscription</h1>

<?php if (isset($errorMessage)): ?>
    <p style="color: red"><?= htmlspecialchars($errorMessage) ?></p>
<?php endif; ?>

<form action="index.php?action=register" method="post">
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>

    <label for="username">Pseudo :</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">S'inscrire</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require 'layout.php' ?>