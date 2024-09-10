<!-- Page title -->
<?php $title = "Mini blog - Accueil"; ?>

<!-- Start capturing main page content -->
<?php ob_start(); ?>

<div class="bg-light">
    <h1>Liste des billets</h1>
</div>

<p class="py-3 mb-5 border-top border-bottom bg-white text-center">Cliquez sur un titre pour afficher le billet</p>

<!-- List of blog posts -->
<ul class="list-group list-group-flush bg-white">
    <?php foreach ($posts as $post): ?>
        <li class="list-group-item list-group-item-action text-center">
            <!-- Link to a specific post -->
            <a href="index.php?execution=post/showOnePost/<?= htmlspecialchars($post->getId()); ?>" class="text-dark fw-semibold text-decoration-none d-block">
                <?= htmlspecialchars($post->getTitle()) ?>
                <span class="text-muted fw-normal fst-italic"> (par <?= htmlspecialchars($post->getAuthorPseudonym()) ?> - <?= $post->getCreationDate() ?>)</span>
            </a>
        </li>
        <!-- Using htmlspecialchars for the id is a priori superfluous, because it's normally an integer from the database ; but I've chosen to systematically process all dynamic datas in this app -->
    <?php endforeach ?>
</ul>

<!-- End of capture of main page content -->
<?php $content = ob_get_clean(); ?>

<!-- Inclusion of the page layout -->
<?php require 'layout.php' ?>