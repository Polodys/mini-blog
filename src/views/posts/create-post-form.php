<!-- Page title -->
<?php $title = "Mon mini blog - Création d'un nouveau billet"; ?>

<!-- Start capturing main page content -->
<?php ob_start(); ?>

<h1>Création d'un nouveau billet</h1>

<?php if (isset($errorMessage)): ?>
    <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($errorMessage) ?>
    </div>
<?php endif; ?>

<!-- New post creation form -->
<form action="index.php?execution=post/createPost" method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Titre :</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Article :</label>
        <textarea class="form-control" id="content" name="content" style="height: 300px" required></textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary px-4 mt-4">Créer le billet</button>
    </div>
</form>

<!-- End of capture of main page content -->
<?php $content = ob_get_clean(); ?>

<!-- Inclusion of the page layout -->
<?php require 'src/views/layout.php'; ?>