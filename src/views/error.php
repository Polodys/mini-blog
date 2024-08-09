<?php $title = "Mon mini blog - Erreur"; ?>

<?php ob_start(); ?>
<h1>Une erreur est survenue !</h1>
<p><?= htmlspecialchars($errorMessage) ?></p>
<?php $content = ob_get_clean(); ?>

<?php require 'layout.php'; ?>