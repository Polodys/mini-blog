<?php

namespace Application\Controllers;

require_once 'src/models/AuthorRepository.php';

use Application\Models\AuthorRepository;

class AuthenticationController
{
    private AuthorRepository $authorRepository;

    public function __construct()
    {
        $this->authorRepository = new AuthorRepository();
    }

    public function register(array $data)
    {
        try {
            // 1- Datas validation
            $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
            $pseudonym = trim($data['pseudonym']);
            $password = $data['password'];

            if (!$email) {
                throw new \Exception("Email invalide.");
            }

            if (empty($pseudonym)) {
                throw new \Exception("Le pseudonyme ne peut pas être vide.");
            }

            // ATTENTION CI-DESSOUS : password fixé à 3 pour faciliter les tests : à remonter à 8 ou plus
            if (strlen($password) < 3) {
                throw new \Exception("Le mot de passe doit contenir au moins 3 caractères.");
            }

            // 2- Creation of a new author
            if ($this->authorRepository->createAuthor($email, $pseudonym, $password)) {
                header('Location: index.php?action=login');
                exit(); // I have to call exit, because setting header alone does not terminate the script execution (https://stackoverflow.com/questions/3553698/php-should-i-call-exit-after-calling-location-header)
            } else {
                $errorMessage = "L'email ou le pseudo est déjà utilisé.";
                require 'src/views/register.php';
            }
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }

    public function registerForm()
    {
        require 'src/views/register.php';
    }

    public function login(array $data)
    {
        try {
            $identifier = trim($data['identifier']);
            $password = $data['password'];

            if (empty($identifier) || empty($password)) {
                $errorMessage = "Identifiants incorrects.";
                require 'src/views/login.php';
                return;
            }

            $author = $this->authorRepository->getAuthorByEmailOrPseudonym($identifier);

            if ($author && password_verify($password, $author->getPassword())) {
                $_SESSION['authorId'] = $author->getId();
                $_SESSION['authorEmail'] = $author->getEmail();
                $_SESSION['authorPseudonym'] = $author->getPseudonym();
                header('Location: index.php');
                exit();
            } else {
                $errorMessage = "Identifiants incorrects.";
                require 'src/views/login.php';
            }
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }

    public function loginForm()
    {
        require 'src/views/login.php';
    }

    public function logout()
    {
        try {
            session_unset();
            session_destroy();
            header('Location: index.php');
            exit();
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }
}
