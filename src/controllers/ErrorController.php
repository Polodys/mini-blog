<?php

namespace Application\Controllers;

class ErrorController
{
    public function errorHandler(\Exception $e)
    {
        $date = date('d.m.Y H:i:s');
        $code = $e->getCode() ? : 500;
        http_response_code($code);
        $errorMessage = $e->getMessage();

        // Previous exception details, if any
        if ($e->getPrevious()) {
            $errorMessage .= ' ; Détails de l\'exception d\'origine : ' . $e->getPrevious()->getMessage();
        }

        $formattedErrorMessage = $date . " : " . "[Code $code] " . $errorMessage . "\n";
        error_log($formattedErrorMessage, 3, 'src/logs/error.log');

        $userErrorMessage = $this->getUserErrorMessage($code);

        require 'src/views/error.php';
    }

    private function getUserErrorMessage($code)
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
