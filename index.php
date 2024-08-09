<?php

session_start();

require_once 'src/controllers/PostController.php'; // ou require_once(__DIR__ . '/src/controllers/PostController.php'); ?
require_once 'src/controllers/AuthController.php';
require_once 'src/controllers/ErrorController.php';

use Application\Controllers\PostController;
use Application\Controllers\AuthController;
use Application\Controllers\ErrorController;

// $postController = new PostController(); // Pas forcément le plus efficace de mettre ça là : à revoir
// $authController = new AuthController(); // Pas forcément le plus efficace de mettre ça là : à revoir

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'register':
                $authController = new AuthController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $authController->register($_POST['email'], $_POST['username'], $_POST['password']);
                } else {
                    $authController->registerForm();
                }
                break;
            case 'login':
                $authController = new AuthController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $authController->login($_POST['identifier'], $_POST['password']);
                } else {
                    $authController->loginForm();
                }
                break;
            case 'logout':
                $authController = new AuthController();
                $authController->logout();
                break;
            default:
                echo "<h1>En cours de construction</h1>";
                break;
        }
    } else {
        $postController = new PostController();
        $postController->index();
    }
} catch (Exception $e) {
    $errorController = new ErrorController();
    $errorController->error($e->getMessage());
    // header('Location: index.php?action=error');
}