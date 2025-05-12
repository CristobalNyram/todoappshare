<?php

use Symfony\Component\HttpFoundation\Request;
use Respect\Validation\Validator as v;

/**
 * Valida los datos de lista de usuarios.
 *
 * @param Request $request
 * @return array Arreglo de errores, vacío si no hay errores.
 */
function validateListUser(Request $request): array {
    $errors = [];

    $nombre = $request->request->get('nombre');
    $usuario = $request->request->get('usuario');
    
    if ($nombre !== null && !v::stringType()->notEmpty()->validate($nombre)) {
        $errors['nombre'] = 'El nombre debe colocarse.';
    }

    if ($usuario !== null && !v::stringType()->notEmpty()->validate($usuario)) {
        $errors['usuario'] = 'El usuario debe colocarse.';
    }

    

    return $errors;
}

function validateUserCreate(Request $request, $meedo): array {
    $errors = [];

    $nombre = $request->request->get('nombre');
    $usuario = $request->request->get('usuario');
    $contrasenia = $request->request->get('contrasenia');
    $paterno = $request->request->get('paterno');

    // Validar nombre
    if (empty($nombre)) {
        $errors['nombre'] = 'El nombre es obligatorio.';
    }

    // Validar usuario
    if (empty($usuario)) {
        $errors['usuario'] = 'El correo electrónico es obligatorio.';
    } elseif ($meedo->has('usuarios', ['usuario' => $usuario])) {
        $errors['usuario'] = 'El correo electrónico ya está registrado.';
    }

    // Validar contrasenia
    if (empty($contrasenia)) {
        $errors['contrasenia'] = 'La contraseña es obligatoria.';
    } elseif (strlen($contrasenia) < 8) {
        $errors['contrasenia'] = 'La contraseña debe tener al menos 8 caracteres.';
    }

    // Validar paterno
    if (empty($paterno)) {
        $errors['paterno'] = 'El apellido paterno es obligatorio.';
    }

    return $errors;
}

function validateUserEdit(Request $request, $meedo, $userId = null): array {
    $errors = [];

    $userId = $request->request->get('id_usuario', $userId);
    $nombre = trim($request->request->get('nombre'));
    $usuario = trim($request->request->get('usuario'));
    $contrasenia = $request->request->get('contrasenia');
    $paterno = $request->request->get('paterno');
    $id_rol = $request->request->get('id_rol');
    $estatus = $request->request->get('estatus');

    $userId = $request->get('id_usuario');
    if (empty($userId)) {
        throw new Exception('ID de usuario no proporcionado.');
    }


    // Validar nombre
    if (empty($nombre)) {
        $errors['nombre'] = 'El nombre es obligatorio.';
    }

    // Validar usuario
    if (empty($usuario)) {
        $errors['usuario'] = 'El nombre de usuario es obligatorio.';
    }

    //Validar paterno
    if (empty($paterno)) {
        $errors['paterno'] = 'El apellido paterno es obligatorio.';
    }

    // Verificamos si el  usuario existe
    $existingUser = $meedo->get('usuarios', '*', ['id_usuario' => $userId]);
    if (!$existingUser) {
        throw new Exception('Usuario no encontrado.');
    }

    // Validar contraseña (solo si se proporciona o es un nuevo usuario)
    if ($userId === null || !empty($contrasenia)) {
        if (empty($contrasenia)) {
            $errors['contrasenia'] = 'La contraseña es obligatoria.';
        } elseif (strlen($contrasenia) < 8) {
            $errors['contrasenia'] = 'La contraseña debe tener al menos 8 caracteres.';
        }
    }

    // Validar rol (si se proporciona)
    if (!empty($id_rol)) {
        if (!is_numeric($id_rol)) {
            $errors['id_rol'] = 'El rol debe ser un valor numérico.';
        } elseif (!$meedo->has('roles', ['id_rol' => $id_rol])) {
            $errors['id_rol'] = 'El rol seleccionado no existe.';
        }
    }

    // Validar estatus (si se proporciona)
    if (!empty($estatus)) {
        $errors['estatus'] = 'El estatus es obligatorio.';
    }


    return $errors;
}

function validateUserEditEstatus(Request $request, $meedo): array {
    $errors = [];

    $id_usuario = $request->get('id_usuario');
    $estatus = $request->get('estatus');

    // Validar que se haya proporcionado el ID de usuario
    if (!$id_usuario) {
        throw new Exception('Ingresar ID de usuario para editar.');
    }

    // Validar que el estatus sea válido (1 o 2)
    if ($estatus != 1 && $estatus != 2) {
        throw new Exception('El estatus debe ser 1 (activo) o 2 (inactivo).');
    }

    // Validar estatus vacío (por si viene null)
    if (empty($estatus)) {
        $errors['estatus'] = 'El estatus es obligatorio.';
    }

    // Verificar que el usuario existe antes de actualizar
    $usuario = $meedo->get('usuarios', '*', ['id_usuario' => $id_usuario]);
    if (!$usuario) {
        throw new Exception('El usuario no existe.');
    }

    return $errors;
}


function validateShowUser(Request $request): array {
    $errors = [];

    $id_usuario = $request->request->get('id_usuario');
    
        if ($id_usuario !== null && !v::stringType()->notEmpty()->validate($id_usuario)) {
            $errors['id_usuario'] = 'El id del usuario debe colocarse.';
        }
    

    return $errors;
}