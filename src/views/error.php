<!-- Page title -->
<?php $title = "Mon mini blog - Erreur"; ?>

<!-- Start capturing main page content -->
<?php ob_start(); ?>

<!-- displays an alert when an error occurs -->
<div class="alert alert-danger text-center" role="alert">
    <h1>Une erreur est survenue !</h1>
    <p class="text-center"><?= htmlspecialchars($userErrorMessage) ?></p>
</div>

<!-- End of capture of main page content -->
<?php $content = ob_get_clean(); ?>

<!-- Inclusion of the page layout -->
<?php require 'layout.php'; ?>