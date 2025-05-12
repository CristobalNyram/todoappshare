<?php

use Symfony\Component\HttpFoundation\Request;
use Respect\Validation\Validator as v;

/**
 * Valida los datos de lista de usuarios.
 *
 * @param Request $request
 * @return array Arreglo de errores, vacío si no hay errores.
 */
function validateListStudents(Request $request): array {
    $errors = [];

    $nombre = $request->request->get('nombre');
    $email = $request->request->get('email');
    
        if ($nombre !== null && !v::stringType()->notEmpty()->validate($nombre)) {
            $errors['nombre'] = 'El nombre debe colocarse.';
        }

        if ($email !== null && !v::email()->notEmpty()->validate($email)) {
            $errors['email'] = 'El correo electrónico no es válido.';
        }
    
    return $errors;
}

function validateStudentsCreate(Request $request, $meedo): array {
    $errors = [];

    $nombre = $request->request->get('nombre');
    $usuario = $request->request->get('usuario');
    $contrasenia = $request->request->get('contrasenia');
    $apellido_p = $request->request->get('apellido_p');
    $apellido_m = $request->request->get('apellido_m');
    $telefono = $request->request->get('telefono');
    $carrera = $request->request->get('carrera');
    $correo = $request->request->get('correo');
    $sexo = $request->request->get('sexo', null);

    //Validamos si el usuario ya existe
    $existingUser = $meedo->get('usuarios', 'id_usuario', ['usuario' => $usuario]);
        if ($existingUser) {
            throw new Exception('El nombre de usuario ya está registrado');
        }
    
     // Validar nombre
    if (empty($nombre)) {
        $errors['nombre'] = 'El nombre es obligatorio.';
    }
    // Validar correo
    if (empty($correo)) {
        $errors['correo'] = 'El correo es obligatorio.';
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errors['correo'] = 'El formato del correo electrónico no es válido.';
    }
    // Validar contrasenia
    if (empty($contrasenia)) {
        $errors['contrasenia'] = 'La contraseña es obligatoria.';
    } elseif (strlen($contrasenia) < 8) {
        $errors['contrasenia'] = 'La contraseña debe tener al menos 8 caracteres.';
    }
        // Validar apellido_p
    if (empty($apellido_p)) {
        $errors['apellido_p'] = 'El apellido paterno es obligatorio.';
    }
    // Validar apellido_m
    if (empty($apellido_m)) {
        $errors['apellido_m'] = 'El apellido paterno es obligatorio.';
    }

    // Validar sexo
    if (empty($sexo)) {
        $errors['sexo'] = 'El sexo es obligatorio.';
    }
    // Validar sexo
    if (empty($telefono)) {
        $errors['telefono'] = 'El telefono es obligatorio.';
    }
    // Validar carrera
    if (empty($carrera)) {
        $errors['carrera'] = 'La carrera es obligatoria.';
    }

    return $errors;
}

function validateEditStudents(Request $request, $meedo): array {
    $errors = [];

    $id_usuario = $request->get('id_usuario');
    $id_alumno = $request->get('id_alumno');
    $nombre = $request->request->get('nombre');
    $usuario = $request->request->get('usuario');
    $contrasenia = $request->request->get('contrasenia');
    $apellido_p = $request->request->get('apellido_p');
    $apellido_m = $request->request->get('apellido_m');
    $telefono = $request->request->get('telefono');
    $carrera = $request->request->get('carrera');
    $correo = $request->request->get('correo');
    $sexo = $request->request->get('sexo', null);

    //Validamos si el usuario ya esta registrado
    $existingUser = $meedo->get('usuarios', 'id_usuario', ['usuario' => $usuario]);
        if ($existingUser) {
            throw new Exception('El nombre de usuario ya está registrado');
        }
        
        //Verificamos que nos den los id a editar
        $id_usuario = $request->get('id_usuario');
        $id_alumno = $request->get('id_alumno');

        if (!$id_usuario || !$id_alumno) {
            throw new Exception('Ingresar ID de usuario y alumno para editar.');
        }
    
     // Validar nombre
     if (empty($nombre)) {
        $errors['nombre'] = 'El nombre es obligatorio.';
    }
    // Validar correo
    if (empty($correo)) {
        $errors['correo'] = 'El correo es obligatorio.';
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errors['correo'] = 'El formato del correo electrónico no es válido.';
    }
    // Validar contrasenia
    if (empty($contrasenia)) {
        $errors['contrasenia'] = 'La contraseña es obligatoria.';
    } elseif (strlen($contrasenia) < 8) {
        $errors['contrasenia'] = 'La contraseña debe tener al menos 8 caracteres.';
    }
        // Validar apellido_p
    if (empty($apellido_p)) {
        $errors['apellido_p'] = 'El apellido paterno es obligatorio.';
    }
    // Validar apellido_m
    if (empty($apellido_m)) {
        $errors['apellido_m'] = 'El apellido paterno es obligatorio.';
    }
    // Validar sexo
    if (empty($sexo)) {
        $errors['sexo'] = 'El sexo es obligatorio.';
    }
    // Validar telefono
    if (empty($telefono)) {
        $errors['telefono'] = 'El telefono es obligatorio.';
    }
    // Validar carrera
    if (empty($carrera)) {
        $errors['carrera'] = 'La carrera es obligatoria.';
    }

    return $errors;
}

function validateEditStudentsEstatus(Request $request, $meedo): array {
    $errors = [];

    $id_alumno = $request->request->get('id_alumno');
    $id_usuario = $request->request->get('id_usuario');
    $estatus = $request->get('estatus');

            
        // Validar que el estatus sea válido (1 o 0)
        if ($estatus != 1 && $estatus != 0) {
            throw new Exception('El estatus debe ser 1 (activo) o 0 (inactivo).');
        }

        //Verificamos que nos den los id a editar
        $id_usuario = $request->get('id_usuario');
        $id_alumno = $request->get('id_alumno');

        if (!$id_usuario || !$id_alumno) {
            throw new Exception('Ingresar ID de usuario y alumno para editar.');
        }
                
        // Verificar que el alumno existe antes de actualizar
        $alumno = $meedo->get('alumnos', '*', ['id_alumno' => $id_alumno]);
        
        if (!$alumno) {
            throw new Exception('El alumno no existe.');
        }

        

    // Validar estatus
    if (empty($estatus)) {
        $errors['estatus'] = 'La estatus es obligatoria.';
    }

    return $errors;
}

function validateShowStudents(Request $request): array {
    $errors = [];

    $id_alumno = $request->request->get('id_alumno');
    
        if ($id_alumno !== null && !v::stringType()->notEmpty()->validate($id_alumno)) {
            $errors['id_alumno'] = 'El id del alumno debe colocarse.';
        }
    

    return $errors;
}