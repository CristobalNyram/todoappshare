<?php 
function userIndex($request) {
    global $meedo;

    $page = max(1, (int)$request->get('page', 1));
    $limit = max(1, (int)$request->get('limit', 100));
    $offset = ($page - 1) * $limit;

    $nombre = $request->get('nombre');
    $usuario = $request->get('usuario');

    $conditions = [];

    if (!empty($nombre)) {
        $conditions['nombre[~]'] = $nombre;
    }

    if (!empty($usuario)) {
        $conditions['usuario[~]'] = $usuario;
    }

    $totalUsers = $meedo->count('usuarios');

    $filteredUsers = $meedo->count('usuarios', $conditions);

    $users = $meedo->select('usuarios', '*', [
        'LIMIT' => [$offset, $limit],
        'ORDER' => ['id_usuario' => 'DESC'],
        ...$conditions
    ]);

    return [
        'status' => true,
        'message' => 'Lista de usuarios',
        'data' => $users,
        'recordsTotal' => $totalUsers,
        'recordsFiltered' => $filteredUsers
    ];
}

function userCreate($request) {
    global $meedo;

    try {
        $nombre = trim($request->get('nombre'));
        $usuario = trim($request->get('usuario'));
        $contrasenia = $request->get('contrasenia');
        $paterno = $request->get('paterno');
        $id_rol = $request->get('id_rol', 3);

        // Iniciar transacción manualmente
        $meedo->pdo->beginTransaction();

        $inserted = $meedo->insert('usuarios', [
            'nombre' => $nombre,
            'usuario' => $usuario,
            'contrasenia' => password_hash($contrasenia, PASSWORD_HASH_CRYPT, PASSWORD_HASH_OPTIONS),
            'paterno' => $paterno,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'fecha_actualizacion' => date('Y-m-d H:i:s'),
            'estatus' => 1
        ]);

        if (!$inserted->rowCount()) {
            throw new Exception('Error al insertar el usuario en la base de datos.');
        }

        $userId = $meedo->id();
        //Insercion tabla rol
        $insertedRoleUser = $meedo->insert('usuarios_roles', [
            'id_usuario' => $userId,
            'id_rol' => $id_rol,
            'fecha_asignacion' => date('Y-m-d H:i:s'),
            'estatus' => 1
        ]);

        if (!$insertedRoleUser->rowCount()) {
            throw new Exception('Error al insertar el rol del usuario en la tabla usuarios_roles.');
        }

        $meedo->pdo->commit(); // Confirmar transacción

        $newUser = $meedo->get('usuarios', '*', ['id_usuario' => $userId]);

        if (!$newUser) {
            throw new Exception('Error al recuperar el usuario recién creado.');
        }

        unset($newUser['password']);

        return [
            'status' => true,
            'message' => 'Usuario creado exitosamente',
            'data' => [
                'user' => $newUser,
                'id' => $userId
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

function userEdit($request) {
    global $meedo;

    try {
        $userId = $request->get('id_usuario', null);
        $nombre = trim($request->get('nombre'));
        $usuario = trim($request->get('usuario'));
        $contrasenia = $request->get('contrasenia');
        $paterno = $request->get('paterno');
        $id_rol = $request->get('id_rol');
        $estatus = $request->get('estatus');

        $meedo->pdo->beginTransaction();

        $userData = [
            'nombre' => $nombre,
            'usuario' => $usuario,
            'fecha_actualizacion' => date('Y-m-d H:i:s')
        ];

        if (!empty($contrasenia)) {
            $userData['contrasenia'] = password_hash($contrasenia, PASSWORD_HASH_CRYPT, PASSWORD_HASH_OPTIONS);
        }

        if (!empty($paterno)) {
            $userData['paterno'] = $paterno;
        }

        if (!empty($estatus)) {
            $userData['estatus'] = $estatus;
        }

        $updated = $meedo->update(
            'usuarios',
            $userData,
            ['id_usuario' => $userId]
        );

        if ($updated->rowCount() === 0) {
            throw new Exception('No se realizaron cambios en los datos del usuario.');
        }

        if (!empty($id_rol)) {
            $updatedRole = $meedo->update('usuarios_roles', [
                'id_rol' => $id_rol,
                'fecha_actualizacion' => date('Y-m-d H:i:s')
            ], ['id_usuario' => $userId]);

            if ($updatedRole->rowCount() === 0) {
                $insertedRole = $meedo->insert('usuarios_roles', [
                    'id_usuario' => $userId,
                    'id_rol' => $id_rol,
                    'fecha_asignacion' => date('Y-m-d H:i:s'),
                    'estatus' => 1
                ]);

                if (!$insertedRole->rowCount()) {
                    throw new Exception('Error al asignar el rol al usuario.');
                }
            }
        }

        // 🔍 Buscar si el usuario es profesor o alumno
        $profesor = $meedo->get('profesores', '*', ['id_usuario' => $userId]);
        $alumno = $meedo->get('alumnos', '*', ['id_usuario' => $userId]);

        $extraData = [
            'nombre' => $nombre,
            'apellido_p' => $paterno,
            'fecha_actualizacion' => date('Y-m-d H:i:s')
        ];

        if ($profesor) {
            $meedo->update('profesores', $extraData, ['id_usuario' => $userId]);
        } elseif ($alumno) {
            $meedo->update('alumnos', $extraData, ['id_usuario' => $userId]);
        }

        $meedo->pdo->commit();

        $updatedUser = $meedo->get('usuarios', '*', ['id_usuario' => $userId]);
        unset($updatedUser['contrasenia']);

        return [
            'status' => true,
            'message' => 'Usuario actualizado exitosamente',
            'data' => [
                'user' => $updatedUser,
                'id' => $userId
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


function userEditEstatus($request) {
    global $meedo;

    try {
        $id_usuario = $request->get('id_usuario');
        $estatus = $request->get('estatus');
        $fechaActualizacion = date('Y-m-d H:i:s');

        // Datos a actualizar
        $update = [
            'estatus' => $estatus,
            'fecha_actualizacion' => $fechaActualizacion
        ];

        $meedo->pdo->beginTransaction();

        // Actualizar usuarios
        $actualizadoUsuario = $meedo->update('usuarios', $update, ['id_usuario' => $id_usuario]);
        $actualizadoAlumno = $meedo->update('alumnos', $update, ['id_usuario' => $id_usuario]);
        $actualizadoProfesor = $meedo->update('profesores', $update, ['id_usuario' => $id_usuario]);

        // Si ninguna tabla fue afectada, lanzar error
        if (!$actualizadoUsuario && !$actualizadoAlumno && !$actualizadoProfesor) {
            throw new Exception('No se actualizó ningún registro.');
        }

        $meedo->pdo->commit();

        // Obtener datos actualizados
        $usuarioActualizado = $meedo->get('usuarios', '*', ['id_usuario' => $id_usuario]);
        $alumnosActualizados = $meedo->select('alumnos', '*', ['id_usuario' => $id_usuario]);
        $profesoresActualizados = $meedo->select('profesores', '*', ['id_usuario' => $id_usuario]);

        return [
            'status' => true,
            'message' => 'Estatus actualizado en usuario, alumno(s) y profesor(es)',
            'data' => [
                'usuario' => $usuarioActualizado,
                'alumnos' => $alumnosActualizados,
                'profesores' => $profesoresActualizados,
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



function showUser($request) {
    global $meedo;

    $userId = $request->get('id_usuario', null);

    // Buscamos el usuario por ID
    $user = $meedo->get('usuarios', '*', [
        'id_usuario' => $userId
    ]);

    // Si no se encuentra el usuario
    if (empty($user)) {
        return [
            'status' => false,
            'message' => 'Usuario no encontrado',
            'data' => null
        ];
    }

    // Devolvemos la respuesta con el usuario encontrado
    return [
        'status' => true,
        'message' => 'Usuario encontrado',
        'data' => $user
    ];
}
?>