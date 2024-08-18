<?php $title = "Connexion"; ?>

<?php ob_start(); ?>

<h1>Connexion</h1>

<?php if (isset($errorMessage)): ?>
    <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($errorMessage) ?>
    </div>
<?php endif; ?>

<form action="index.php?execution=authentication/login" method="post">
    <div class="mb-3">
        <label for="identifier" class="form-label">Email ou Pseudo :</label>
        <input type="text" class="form-control" id="identifier" name="identifier" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe :</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary px-4 mt-4">Se connecter</button>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require 'layout.php' ?>