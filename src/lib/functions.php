<?php

/**
 * Validates an identifier (verifies if the given identifier is a strictly positive integer)
 *
 * @param string $id The identifier to validate (a string, as it is extract from the URL)
 * @return int The validated identifier as an integer
 * @throws Exception If the identifier is not valid (i.e. if not a strictly positive integer)
 */
function validateId(string $id): int
{
    // integer conversion of the id
    $id = (int) $id; 

    // verification : is the id strictly positive ?
    if ($id > 0) {
        return $id;
    } else {
        throw new Exception("La page ne peut pas s'afficher : identifiant non valide.");
    };
}