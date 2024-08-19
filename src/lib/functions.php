<?php

function validateId(string $id)
{
    $id = isset($id) ? (int) $id : 0; 
    if ($id > 0) {
        return $id;
    } else {
        throw new Exception("La page ne peut pas s'afficher : identifiant non valide.");
    };
}
