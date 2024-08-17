<?php $title = "Affichage d'un billet"; ?>

<?php ob_start(); ?>

<h1><?= htmlspecialchars($post->getTitle()) ?></h1>
<p class="text-center">Par <?= htmlspecialchars($post->getAuthorPseudonym()) ?> (<?= $post->getCreationDate() ?>)</p>

<?php if (isset($_SESSION['authorPseudonym']) && (int) $_SESSION['authorId'] === (int) $post->getAuthorId()): ?>
    <div class="text-center">
        <a href="index.php?action=update-post&id=<?= htmlspecialchars($post->getId()); ?>" class="btn btn-primary px-4 mx-3 mt-2 mb-5">Modifier</a>
        <button type="button" class="btn btn-danger px-4 mx-3 mt-2 mb-5" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Supprimer</button>
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="confirmDeleteModalLabel">Confirmation de suppression</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce billet ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <a href="index.php?action=delete-post&id=<?= htmlspecialchars($post->getId()); ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<p class="text-justify" style="text-align: justify"><?= nl2br(htmlspecialchars($post->getContent())) ?></p>

<?php $content = ob_get_clean() ?>

<?php require 'src/views/layout.php' ?>
