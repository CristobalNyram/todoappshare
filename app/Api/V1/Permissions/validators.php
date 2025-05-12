<?php

use Symfony\Component\HttpFoundation\Request;
use Respect\Validation\Validator as v;

/**
 * Valida los datos de lista de usuarios.
 *
 * @param Request $request
 * @return array Arreglo de errores, vacío si no hay errores.
 */
function validateListPermissions(Request $request): array {
    $errors = [];

    $id_permiso = $request->request->get('id_permiso', null);
    
        if ($id_permiso !== null && !v::stringType()->notEmpty()->validate($id_permiso)) {
            $errors['id_permiso'] = 'El id del permiso debe colocarse.';
        }

    return $errors;
}

function validateCreatePermissions(Request $request, $meedo): array {
    $errors = [];

    $id_rol = $request->request->get('id_rol');
    $id_permiso = $request->request->get('id_permiso');

    // Validar id_rol
    if ($id_rol === null || !v::intVal()->validate($id_rol)) {
        $errors['id_rol'] = 'El id del rol debe colocarse y ser un número entero.';
    }

    // Validar id_permiso
    if ($id_permiso !== null) {
        if (!v::intVal()->validate($id_permiso)) {
            $errors['id_permiso'] = 'El id del permiso debe ser un número entero.';
        }
    }

    // Validar rol permisos
    if (empty($errors)) {
        $exists = $meedo->has('roles_plataforma_permisos', [
            'AND' => [
                'id_rol' => $id_rol,
                'id_permiso' => $id_permiso
            ]
        ]);

        if ($exists) {
            $errors['permiso_existente'] = 'Este rol ya tiene asignado este permiso.';
        }
    }

    return $errors;
}
