<?php

use Symfony\Component\HttpFoundation\Request;
use Respect\Validation\Validator as v;

/**
 * Valida los datos de inicio de sesión.
 *
 * @param Request $request
 * @return array Arreglo de errores, vacío si no hay errores.
 */
function validateLogin(Request $request): array
{
    $errors = [];

    // Obtener y validar los campos
    $email = $request->request->get('email');
    $password = $request->request->get('password');

    if (!v::notEmpty()->email()->validate($email)) {
        $errors['email'] = 'El correo electrónico no es válido.('.$email.')';
    }

    if (!v::notEmpty()->length(3, null)->validate($password)) {
        $errors['password'] = 'La contraseña debe tener al menos 6 caracteres.';
    }

    return $errors;
}
