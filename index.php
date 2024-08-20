<?php

session_start();

// Configuration of error reporting (in production, set 0 ; in developpement, set 1 - enables errors to be displayed on screen)
// ini_set('display_errors', 0);

// Loading controllers
require_once 'src/controllers/PostController.php';
require_once 'src/controllers/AuthenticationController.php';
require_once 'src/controllers/ErrorController.php';

use Application\Controllers\PostController;
use Application\Controllers\AuthenticationController;
use Application\Controllers\ErrorController;

try {
    // Extracting and parsing URL elements to select the controller and method to execute
    $execution = $_GET['execution'] ?? 'post/homepage';
    $array = explode('/', $execution);

    $controllerName = ucfirst($array[0]) . 'Controller'; // ucfirst () = UpperCase for FIRST character (used to match the controller class name)
    $method = $array[1] ?? 'homepage';
    $arg = $array[2] ?? null;

    // Mapping the controller name to its class
    $controllersMap = [
        'PostController' => PostController::class,
        'AuthenticationController' => AuthenticationController::class,
    ];

    // Throws an exception if the controller does not exist
    if (!isset($controllersMap[$controllerName])) {
        throw new Exception("Le contrôleur spécifié n'existe pas.");
    }

    $controllerClass = $controllersMap[$controllerName];
    $controller = new $controllerClass();

    // Calling the controller method (and passing arguments if necessary)
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
