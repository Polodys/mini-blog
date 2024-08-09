<?php $title = "Connexion"; ?>

<?php ob_start(); ?>

<h1>Connexion</h1>

<?php if (isset($errorMessage)): ?>
    <p style="color: red"><?= htmlspecialchars($errorMessage) ?></p>
<?php endif; ?>

<form action="index.php?action=login" method="post">
    <label for="identifier">Email ou Pseudo :</label>
    <input type="text" id="identifier" name="identifier" required>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Se connecter</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require 'layout.php' ?>