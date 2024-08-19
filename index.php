<?php

session_start();

// ini_set('display_errors', 0); // In production, choose 0 ; in developpement, choose 1 (enables errors to be displayed on screen)

require_once 'src/controllers/PostController.php'; // or require_once(__DIR__ . '/src/controllers/PostController.php');
require_once 'src/controllers/AuthenticationController.php';
require_once 'src/controllers/ErrorController.php';

use Application\Controllers\PostController;
use Application\Controllers\AuthenticationController;
use Application\Controllers\ErrorController;

try {
    // Extracting URL elements
    $execution = $_GET['execution'] ?? 'post/homepage';
    $array = explode('/', $execution);

    $controllerName = ucfirst($array[0]) . 'Controller'; // ucfirst () = UpperCase for FIRST character 
    $method = $array[1] ?? 'homepage';
    $arg = $array[2] ?? null;

    // Mapping the controller name to his class
    $controllersMap = [
        'PostController' => PostController::class,
        'AuthenticationController' => AuthenticationController::class,
    ];

    if (!isset($controllersMap[$controllerName])) {
        throw new Exception("Le contrôleur spécifié n'existe pas.");
    }

    $controllerClass = $controllersMap[$controllerName];
    $controller = new $controllerClass();

    // Calling the controller method
    if (method_exists($controller, $method)) {
        if ($arg !== null) {
            $controller->$method($arg);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->$method($_POST);
        } else {
            $controller->$method();
        }
    } else {
        throw new Exception("L'action spécifiée n'existe pas.");
    }
} catch (Exception $e) {
    $errorController = new ErrorController();
    $errorController->errorHandler($e);
}
