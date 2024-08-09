<?php

namespace Application\Controllers;

class ErrorController
{
    public function error(string $errorMessage)
    {
        require 'src/views/error.php';
    }
}