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

    public function register($email, $pseudonym, $password)
    {
        try {
            if ($this->authorRepository->createAuthor($email, $pseudonym, $password)) {
                header('Location: index.php?action=login');
            } else {
                $errorMessage = "L'email ou le pseudo est déjà utilisé.";
                require 'src/views/register.php';
            }
        } catch (\Exception $e) {
            $errorMessage = "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
            require 'src/views/register.php';
        }
    }

    public function registerForm()
    {
        require 'src/views/register.php';
    }

    public function login($identifier, $password)
    {
        $author = $this->authorRepository->getAuthorByEmailOrPseudonym($identifier);

        if ($author && password_verify($password, $author->getPassword())) {
            $_SESSION['author_id'] = $author->getId();
            $_SESSION['pseudonym'] = $author->getPseudonym();
            header('Location: index.php');
        } else {
            $errorMessage = "Identifiants incorrects.";
            require 'src/views/login.php';
        }
    }

    public function loginForm()
    {
        require 'src/views/login.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php');
    }
}
