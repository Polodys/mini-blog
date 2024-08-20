<?php

namespace Application\Controllers;

require_once 'src/models/AuthorRepository.php';

use Application\Models\AuthorRepository;

/**
 * Controller that handles the authentication of the authors
 */
class AuthenticationController
{
    private AuthorRepository $authorRepository;

    public function __construct()
    {
        $this->authorRepository = new AuthorRepository();
    }

    /**
     * Handles new author registration
     *
     * @param array $data Datas received from the registration form
     */
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

            // checks if the password follows the right pattern
            $passwordPattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[&_\+\-\*\/\$£%@#!:;,?])[A-Za-z\d&_\+\-\*\/\$£%@#!:;,?]{8,25}$/';

            if (!preg_match($passwordPattern, $password)) {
                throw new \Exception("Le mot de passe doit contenir entre 8 et 25 caractères, avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.");
            }

            // 2- Creation of a new author
            if ($this->authorRepository->createAuthor($email, $pseudonym, $password)) {
                // redirects to login form when the registration is successfull
                header('Location: index.php?execution=authentication/loginForm');
                exit(); // Ensure that the script stops after redirection
            } else {
                $errorMessage = "L'email ou le pseudo est déjà utilisé.";
                require 'src/views/register.php';
            }
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }

    /**
     * Displays the registration form
     */
    public function registerForm()
    {
        require 'src/views/register.php';
    }

    /**
     * Handles the connexion of an author
     *
     * @param array $data
     * @return void
     */
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
                // Stores author informations in the session when login is successfull
                $_SESSION['authorId'] = $author->getId();
                $_SESSION['authorEmail'] = $author->getEmail();
                $_SESSION['authorPseudonym'] = $author->getPseudonym();
                header('Location: index.php?execution=post/homepage');
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

    /**
     * Displays the author login form
     */
    public function loginForm()
    {
        require 'src/views/login.php';
    }

    /**
     * Disconnects the logged author
     *
     * @return void
     */
    public function logout()
    {
        try {
            session_unset();
            session_destroy();
            header('Location: index.php?execution=post/homepage');
            exit();
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }
}
