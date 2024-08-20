<!-- Page title -->
<?php $title = "Modification d'un billet"; ?>

<!-- Start capturing main page content -->
<?php ob_start(); ?>

<h1>Modification du billet</h1>

<!-- post update form -->
<form action="index.php?execution=post/updatePost" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($post->getId()) ?>">
    <div class="mb-3">
        <label for="title" class="form-label">Titre :</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= htmlspecialchars($post->getTitle()) ?>" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Article :</label>
        <textarea name="content" class="form-control" id="content" style="height: 400px" required><?= htmlspecialchars($post->getContent()) ?></textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary px-4 mt-4">Mettre à jour</button>
    </div>
</form>

<!-- End of capture of main page content -->
<?php $content = ob_get_clean() ?>

<!-- Inclusion of the page layout -->
<?php require 'src/views/layout.php' ?>