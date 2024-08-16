<?php $title = "Mon mini blog - Erreur"; ?>

<?php ob_start(); ?>
<div class="alert alert-danger text-center" role="alert">
    <h1>Une erreur est survenue !</h1>
    <p class="text-center"><?= htmlspecialchars($userErrorMessage) ?></p>
</div>
<?php $content = ob_get_clean(); ?>

<?php require 'layout.php'; ?>