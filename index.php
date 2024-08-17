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
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new AuthenticationController())->register($_POST);
                } else {
                    (new AuthenticationController())->registerForm();
                }
                break;
            case 'login':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new AuthenticationController())->login($_POST);
                } else {
                    (new AuthenticationController())->loginForm();
                }
                break;
            case 'logout':
                (new AuthenticationController())->logout();
                break;
            case 'create-post-form':
                (new PostController())->createPostForm();
                break;
            case 'create-post':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new PostController())->createPost($_POST);
                } else {
                    (new PostController())->createPostForm();
                }
                break;
            case 'show-one-post':
                $id = validateId($_GET['id']);
                (new PostController())->showOnePost($id);
                break;
            case 'update-post':
                $id = validateId($_GET['id']);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new PostController())->updatePost($id, $_POST);
                } else {
                    (new PostController())->updatePostForm($id);
                }
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
        (new PostController())->homepage();
    }
} catch (Exception $e) {
    (new ErrorController())->errorHandler($e);
}
