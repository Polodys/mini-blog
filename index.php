<?php

session_start();

// ini_set('display_errors', 0); // In production, choose 0 ; in developpement, choose 1 (enables errors to be displayed on screen)

require_once 'src/controllers/PostController.php'; // or require_once(__DIR__ . '/src/controllers/PostController.php');
require_once 'src/controllers/AuthenticationController.php';
require_once 'src/controllers/ErrorController.php';

use Application\Controllers\PostController;
use Application\Controllers\AuthenticationController;
use Application\Controllers\ErrorController;

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
                    $authenticationController->register($_POST);
                } else {
                    $authenticationController->registerForm();
                }
                break;
            case 'login':
                $authenticationController = new AuthenticationController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $authenticationController->login($_POST);
                } else {
                    $authenticationController->loginForm();
                }
                break;
            case 'logout':
                $authenticationController = new AuthenticationController();
                $authenticationController->logout();
                break;
            case 'create-post-form':
                (new PostController())->createPostForm();
                break;
            case 'create-post':
                $postController = new PostController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $postController->createPost($_POST);
                } else {
                    $postController->createPostForm();
                }
                break;
            case 'show-one-post':
                $id = validateId($_GET['id']);
                (new PostController())->showOnePost($id);
                break;
            case 'update-post-form':
                $id = validateId($_GET['id']);
                (new PostController())->updatePostForm($id);
                break;
            case 'update-post':
                $id = validateId($_GET['id']);
                (new PostController())->updatePost($id, $_POST);
                break;
            case 'delete-post':
                $id = validateId($_GET['id']);
                (new PostController())->deletePost($id);
                break;
            default:
                throw new Exception('Page non trouvée', 404);
                break;
        }
    } else {
        $postController = new PostController();
        $postController->homepage();
    }
} catch (Exception $e) {
    $errorController = new ErrorController();
    $errorController->errorHandler($e);
}
