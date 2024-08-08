<?php

require_once 'src/controllers/PostController.php';

use Application\Controllers\PostController;

$postController = new PostController();

if (isset($_GET['action'])) {
    echo "<h1>En cours de construction</h1>";
} else {
    $postController->index();
}