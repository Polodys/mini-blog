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

$routes = [
    'GET' => [
        'register' => [AuthenticationController::class, 'registerForm', false],
        'login' => [AuthenticationController::class, 'loginForm', false],
        'logout' => [AuthenticationController::class, 'logout', false],
        'create-post' => [PostController::class, 'createPostForm', false],
        'show-one-post' => [PostController::class, 'showOnePost', true], // $id
        'update-post' => [PostController::class, 'updatePostForm', true], // $id
        'delete-post' => [PostController::class, 'deletePost', true], // $id
    ],
    'POST' => [
        'register' => [AuthenticationController::class, 'register', false], // $_POST (email, pseudonym, password)
        'login' => [AuthenticationController::class, 'login', false], // $_POST (identifier, password)
        'create-post' => [PostController::class, 'createPost', false], // $_POST (title, content)
        'update-post' => [PostController::class, 'updatePost', true], // $id + $_POST (title, content)
    ],
];

try {
    $action = $_GET['action'] ?? '';
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    if (isset($routes[$requestMethod][$action])) {
        [$controllerClass, $method, $requiresId] = $routes[$requestMethod][$action];
        $controller = new $controllerClass();
        
        // Validate ID if required
        $id = $requiresId ? validateId($_GET['id'] ?? '') : null;
        
        // Call the appropriate method
        if ($requestMethod === 'POST') {
            $id !== null ? $controller->$method($id, $_POST) : $controller->$method($_POST);
        } else { 
            $id !== null ? $controller->$method($id) : $controller->$method();
        }
    } else {
        // By default : to homepage, if no action is set or unknown action
        (new PostController())->homepage();
    }
} catch (Exception $e) {
    $errorController = new ErrorController();
    $errorController->errorHandler($e);
}
