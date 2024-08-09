<?php

require_once 'src/controllers/PostController.php';
require_once 'src/controllers/ErrorController.php';

use Application\Controllers\PostController;
use Application\Controllers\ErrorController;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        echo "En cours de construction";
    } else {
        (new PostController())->index();
    }
} catch (Exception $e) {
    $errorController = new ErrorController();
    $errorController->error($e->getMessage());
}