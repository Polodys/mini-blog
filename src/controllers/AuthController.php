<?php

namespace Application\Controllers;

require_once 'src/models/UserRepository.php';

use Application\Models\UserRepository;

class AuthController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function register($email, $username, $password)
    {
        try {
            if ($this->userRepository->createUser($email, $username, $password)) {
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
        $user = $this->userRepository->getUserByEmailOrUsername($identifier);

        if ($user && password_verify($password, $user->getPassword())) {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
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
