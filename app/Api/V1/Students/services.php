<?php
function studentsIndex($request) {
    global $meedo;

    $page = max(1, (int)$request->get('page', 1));
    $limit = max(1, (int)$request->get('limit', 100));
    $offset = ($page - 1) * $limit;

    $filters = [
        'limit' => $limit,
        'page' => $page
    ];

    $nombre = $request->get('nombre', null);
    $correo = $request->get('correo', null);

    $conditions = [];
    if (!empty($nombre)) {
        $filters['nombre'] = $nombre;
        $conditions['nombre[~]'] = $nombre;
    }
    if (!empty($correo)) {
        $filters['correo'] = $correo;
        $conditions['correo[~]'] = $correo;
    }

    $totalStudent = $meedo->count('alumnos');

    $filteredStudents = $meedo->count('alumnos', $conditions);

    $users = $meedo->select('alumnos', '*', [
        'LIMIT' => [$offset, $limit],
        'ORDER' => ['id_alumno' => 'DESC'],
        ...$conditions
    ]);

    return [
        'status' => true,
        'message' => 'Lista de alumnos obtenida exitosamente',
        'data' => $users,
        'recordsTotal' => $totalStudent,
        'recordsFiltered' => $filteredStudents
    ];
}

function studentsCreate($request) {
    global $meedo;

    try {
        $nombre = trim($request->get('nombre'));
        $apellido_p = trim($request->get('apellido_p'));
        $apellido_m = trim($request->get('apellido_m'));
        $usuario = trim($request->get('usuario'));
        $correo = trim($request->get('correo'));
        $telefono = trim($request->get('telefono'));
        $carrera = trim($request->get('carrera'));
        $contrasenia = $request->get('contrasenia');
        $sexo = $request->get('sexo', null);
        $id_rol = 5; // Rol para alumnos

        // Iniciar transacción
        $meedo->pdo->beginTransaction();

        $insertedUser = $meedo->insert('usuarios', [
            'nombre' => $nombre,
            'usuario' => $usuario,
            'paterno' => $apellido_p,
            'contrasenia' => password_hash($contrasenia, PASSWORD_HASH_CRYPT, PASSWORD_HASH_OPTIONS),
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'fecha_actualizacion' => date('Y-m-d H:i:s'),
            'estatus' => 1
        ]);

        if (!$insertedUser->rowCount()) {
            throw new Exception('Error al insertar el usuario en la base de datos.');
        }

        $userId = $meedo->id();
        if (!$userId) {
            throw new Exception('No se pudo obtener el ID del usuario insertado');
        }

        // 2. Insertar rol de usuario
        $insertedRoleUser = $meedo->insert('usuarios_roles', [
            'id_usuario' => $userId,
            'id_rol' => $id_rol,
            'fecha_asignacion' => date('Y-m-d H:i:s'),
            'estatus' => 1
        ]);

        if (!$insertedRoleUser->rowCount()) {
            throw new Exception('Error al asignar el rol al usuario.');
        }

        // 3. Insertar en tabla alumnos
        $insertedAlumno = $meedo->insert('alumnos', [
            'id_usuario' => $userId,
            'nombre' => $nombre,
            'apellido_p' => $apellido_p,
            'apellido_m' => $apellido_m,
            'correo' => $correo,
            'telefono' => $telefono,
            'carrera' => $carrera,
            'sexo' => $sexo,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'fecha_actualizacion' => date('Y-m-d H:i:s'),
            'estatus' => 1
        ]);

        if (!$insertedAlumno->rowCount()) {
            throw new Exception('Error al insertar el alumno en la base de datos.');
        }

        $alumnoId = $meedo->id();
        if (!$alumnoId) {
            throw new Exception('No se pudo obtener el ID del alumno insertado');
        }

        // Confirmar transacción
        $meedo->pdo->commit();

        // Obtener datos del alumno recién creado
        $newAlumno = $meedo->get('alumnos', '*', ['id_alumno' => $alumnoId]);
        $newUser = $meedo->get('usuarios', '*', ['id_usuario' => $userId]);

        if (!$newAlumno || !$newUser) {
            throw new Exception('Error al recuperar los datos del alumno creado.');
        }

        // Eliminar datos sensibles antes de retornar
        unset($newUser['contrasenia']);

        return [
            'status' => true,
            'message' => 'Alumno creado exitosamente',
            'data' => [
                'alumno' => $newAlumno,
                'usuario' => $newUser,
                'id_alumno' => $alumnoId,
                'id_usuario' => $userId
            ]
        ];

    } catch (Exception $e) {
        // Rollback si ocurre error
        if ($meedo->pdo->inTransaction()) {
            $meedo->pdo->rollBack();
        }

        return [
            'status' => false,
            'message' => $e->getMessage(),
            'data' => []
        ];
    }
}

function studentsEdit($request) {
    global $meedo;

    try {
        $id_usuario = $request->get('id_usuario');
        $id_alumno = $request->get('id_alumno');
        $nombre = trim($request->get('nombre'));
        $apellido_p = trim($request->get('apellido_p'));
        $apellido_m = trim($request->get('apellido_m'));
        $usuario = trim($request->get('usuario'));
        $correo = trim($request->get('correo'));
        $contrasenia = $request->get('contrasenia');
        $telefono = trim($request->get('telefono'));
        $carrera = trim($request->get('carrera'));
        $sexo = $request->get('sexo', null);

        $updateUsuario = [
            'nombre' => $nombre,
            'usuario' => $usuario,
            'paterno' => $apellido_p,
            'fecha_actualizacion' => date('Y-m-d H:i:s')
        ];

        if (!empty($contrasenia)) {
            $updateUsuario['contrasenia'] = password_hash($contrasenia, PASSWORD_HASH_CRYPT, PASSWORD_HASH_OPTIONS);
        }

        $updateAlumno = [
            'nombre' => $nombre,
            'apellido_p' => $apellido_p,
            'apellido_m' => $apellido_m,
            'correo' => $correo,
            'sexo' => $sexo,
            'telefono' => $telefono,
            'carrera' => $carrera,
            'fecha_actualizacion' => date('Y-m-d H:i:s')
        ];

        // Iniciar transacción
        $meedo->pdo->beginTransaction();

        $meedo->update('usuarios', $updateUsuario, ['id_usuario' => $id_usuario]);
        $meedo->update('alumnos', $updateAlumno, ['id_alumno' => $id_alumno]);

        // Confirmar transacción
        $meedo->pdo->commit();

        // Obtener datos actualizados
        $updatedAlumno = $meedo->get('alumnos', '*', ['id_alumno' => $id_alumno]);
        $updatedUser = $meedo->get('usuarios', '*', ['id_usuario' => $id_usuario]);

        if (!$updatedAlumno || !$updatedUser) {
            throw new Exception('Error al recuperar los datos del alumno actualizado.');
        }

        // Eliminar datos sensibles antes de retornar
        unset($updatedUser['contrasenia']);

        return [
            'status' => true,
            'message' => 'Alumno actualizado exitosamente',
            'data' => [
                'alumno' => $updatedAlumno,
                'usuario' => $updatedUser,
                'id_alumno' => $id_alumno,
                'id_usuario' => $id_usuario
            ]
        ];

    } catch (Exception $e) {
        if ($meedo->pdo->inTransaction()) {
            $meedo->pdo->rollBack();
        }

        return [
            'status' => false,
            'message' => $e->getMessage(),
            'data' => []
        ];
    }
}

function studentsEditEstatus($request) {
    global $meedo;

    try {
        $id_alumno = $request->get('id_alumno');
        $id_usuario = $request->get('id_usuario');
        $estatus = $request->get('estatus');

            // obtenemos el id del alumno para comprobar que el id del usuario coincida
            $alumno = $meedo->get('alumnos', '*', ['id_alumno' => $id_alumno]);
            $id_usuario = $alumno['id_usuario'];
        
            if (!$id_usuario) {
                throw new Exception('No se encontró un usuario asociado a este alumno.');
            }
            
        
        // Fecha de actualización para ambas tablas
        $fechaActualizacion = date('Y-m-d H:i:s');
        
        // Datos a actualizar en alumnos
        $updateAlumno = [
            'estatus' => $estatus,
            'fecha_actualizacion' => $fechaActualizacion
        ];
        
        // Datos a actualizar en usuarios
        $updateUsuario = [
            'estatus' => $estatus,
            'fecha_actualizacion' => $fechaActualizacion
        ];

        $meedo->pdo->beginTransaction();
        
        $actualizadoAlumno = $meedo->update('alumnos', $updateAlumno, ['id_alumno' => $id_alumno]);
        $actualizadoUsuario = $meedo->update('usuarios', $updateUsuario, ['id_usuario' => $id_usuario]);
        
        if (!$actualizadoAlumno || !$actualizadoUsuario) {
            throw new Exception('Error al actualizar el estatus.');
        }

        $meedo->pdo->commit();
        
        $alumnoActualizado = $meedo->get('alumnos', '*', ['id_alumno' => $id_alumno]);
        $usuarioActualizado = $meedo->get('usuarios', '*', ['id_usuario' => $id_usuario]);
        
        if (!$alumnoActualizado || !$usuarioActualizado) {
            throw new Exception('Error al recuperar los datos actualizados.');
        }
        
        // Respuesta exitosa
        return [
            'status' => true,
            'message' => 'Estatus actualizado exitosamente en ambas tablas',
            'data' => [
                'alumno' => $alumnoActualizado,
                'usuario' => $usuarioActualizado,
                'id_alumno' => $id_alumno,
                'id_usuario' => $id_usuario,
                'estatus' => $estatus
            ]
        ];

    } catch (Exception $e) {
        if ($meedo->pdo->inTransaction()) {
            $meedo->pdo->rollBack();
        }
        
        return [
            'status' => false,
            'message' => $e->getMessage(),
            'data' => []
        ];
    }
}

function showStudents($request) {
    global $meedo;

    $id_alumno = $request->get('id_alumno', null);

    // Buscamos el alumno por ID
    $user = $meedo->get('alumnos', '*', [
        'id_alumno' => $id_alumno
    ]);

    // Si no se encuentra el alumno, devolvemos un error
    if (empty($user)) {
        return [
            'status' => false,
            'message' => 'Alumno no encontrado',
            'data' => null
        ];
    }

    // Devolvemos la respuesta con el usuario encontrado
    return [
        'status' => true,
        'message' => 'Alumno encontrado',
        'data' => $user
    ];
}

?>