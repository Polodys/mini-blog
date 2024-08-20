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
            Votre mot de passe doit contenir entre 8 et 25 caractères, avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial parmi ceux autorisés (& _ + - * / $ £ % @ # ! : ; , ?).
        </div>
    </div>
    <!-- Modal alert for invalid password -->
    <div class="modal fade" id="invalidPasswordModal" tabindex="-1" aria-labelledby="invalidPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="invalidPasswordModalLabel">Mot de passe invalide</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                Le mot de passe doit contenir entre 8 et 25 caractères, avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary px-4 mt-4">S'inscrire</button>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require 'layout.php' ?>