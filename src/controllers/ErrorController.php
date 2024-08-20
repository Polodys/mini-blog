<?php

namespace Application\Controllers;

/**
 * Error controller
 * Handles errors and exceptions, records details in a log file and displays an appropriate
 * error to the user
 */
class ErrorController
{
    /**
     * Error handler
     * Records errors in the log file and displays an error page to the user
     *
     * @param \Exception $e The exception to handle
     */
    public function errorHandler(\Exception $e)
    {
        $date = date('d.m.Y H:i:s');
        $code = $e->getCode() ? : 500;
        http_response_code($code);
        $errorMessage = $e->getMessage();

        // Adds the previous exception details, if any
        if ($e->getPrevious()) {
            $errorMessage .= ' ; Détails de l\'exception d\'origine : ' . $e->getPrevious()->getMessage();
        }

        // Formats the error message for the log
        $formattedErrorMessage = $date . " : " . "[Code $code] " . $errorMessage . "\n";
        error_log($formattedErrorMessage, 3, 'src/logs/error.log');

        // Gets the message to display to the user
        $userErrorMessage = $this->getUserErrorMessage($code);

        require 'src/views/error.php';
    }

    /**
     * Returns an error message for the user, based on the HTTP error code
     *
     * @param int $code The HTTP error code
     * @return string The error message for the user
     */
    private function getUserErrorMessage(int $code): string
    {
        switch ($code) {
            case 400:
                return 'Requête invalide.';
            case 401:
                return 'Non autorisé.';
            case 403:
                return 'Accès refusé.';
            case 404:
                return 'Page non trouvée.';
            default:
                return 'Une erreur interne est survenue. Veuillez réessayer plus tard.';
        }
    }
}
