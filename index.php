<?php

session_start();

require_once 'src/controllers/PostController.php'; // ou require_once(__DIR__ . '/src/controllers/PostController.php'); ?
require_once 'src/controllers/AuthenticationController.php';
require_once 'src/controllers/ErrorController.php';

use Application\Controllers\PostController;
use Application\Controllers\AuthenticationController;
use Application\Controllers\ErrorController;

// $postController = new PostController(); // Pas forcément le plus efficace de mettre ça là : à revoir
// $authenticationController = new AuthenticationController(); // Pas forcément le plus efficace de mettre ça là : à revoir

function validateId(string $id)
{
    $id = isset($id) ? (int) $id : 0;

    if ($id > 0) {
        return $id;
    } else {
        throw new Exception("La page ne peut pas s'afficher : identifiant non valide.");
    };
}

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'register':
                $authenticationController = new AuthenticationController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $authenticationController->register($_POST['email'], $_POST['pseudonym'], $_POST['password']);
                } else {
                    $authenticationController->registerForm();
                }
                break;
            case 'login':
                $authenticationController = new AuthenticationController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $authenticationController->login($_POST['identifier'], $_POST['password']);
                } else {
                    $authenticationController->loginForm();
                }
                break;
            case 'logout':
                $authenticationController = new AuthenticationController();
                $authenticationController->logout();
                break;
            case 'show-one-post':
                $id = validateId($_GET['id']);
                $postController = new PostController();
                $postController->showOnePost($id);
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