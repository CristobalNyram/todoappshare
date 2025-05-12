<?php

use Symfony\Component\HttpFoundation\Request;
use Respect\Validation\Validator as v;

/**
 * Valida los datos de lista de usuarios.
 *
 * @param Request $request
 * @return array Arreglo de errores, vacío si no hay errores.
 */
function validateListRoles(Request $request): array {
    $errors = [];

    $id_rol = $request->request->get('id_rol', null);
    
        if ($id_rol !== null && !v::stringType()->notEmpty()->validate($id_rol)) {
            $errors['id_rol'] = 'El id del rol debe colocarse.';
        }

    return $errors;
}

function validateCreateRoles(Request $request, $meedo): array {
        $errors = [];
    
        $nombre = $request->request->get('nombre');
        $descripcion = $request->request->get('descripcion');
        $orden = $request->request->get('orden', 0);

        if ($nombre !== null && !v::stringType()->notEmpty()->validate($nombre)) {
            $errors['nombre'] = 'El nombre del rol debe colocarse.';
        }

        if ($descripcion !== null && !v::stringType()->notEmpty()->validate($descripcion)) {
            $errors['descripcion'] = 'La descripcion del rol debe colocarse.';
        }

        if ($orden !== null && !v::stringType()->notEmpty()->validate($orden)) {
            $errors['orden'] = 'El orden del rol debe colocarse.';
        }

    return $errors;
}