<?php

namespace Application\Controllers;

class ErrorController
{
    // The detailled error message is saved in error.log, and a less detailled error message is displayed for the user
    public function error(string $errorMessage)
    {
        $formattedErrorMessage = $errorMessage . "\n"; // Just to have a line break after each error message

        error_log($formattedErrorMessage, 3, 'src/logs/error.log');
        
        $userErrorMessage = "Une erreur interne est survenue. Veuillez réessayer plus tard.";
        
        require 'src/views/error.php';
    }
}