<?php $title = "Inscription"; ?>

<?php ob_start(); ?>

<h1>Inscription</h1>

<?php if (isset($errorMessage)): ?>
    <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($errorMessage) ?>
    </div>
<?php endif; ?>

<form action="index.php?execution=authentication/register" method="post">
    <div class="mb-3">
        <label for="email" class="form-label">Email :</label>
        <input type="email" class="form-control" id="email" name="email" required>
        <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
    </div>
    <div class="mb-3">
        <label for="pseudonym" class="form-label">Pseudo :</label>
        <input type="text" class="form-control" id="pseudonym" name="pseudonym" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label" aria-describedby="passwordHelpBlock">Mot de passe :</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <div id="passwordHelpBlock" class="form-text">
            Votre mot de passe doit contenir au moins 8 caractères.
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary px-4 mt-4">S'inscrire</button>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require 'layout.php' ?>