<?php
function rolesIndex($request) {
    global $meedo;

    $page = (int)$request->get('page', 1);
    $limit = (int)$request->get('limit', 100);
    $filters = [
        'limit' => $limit,
        'page' => $page
    ];
    $id_rol = $request->get('id_rol', null);

    // FILTROS
    $conditions = [];
    if (!empty($id_rol)) {
        $filters['id_rol'] = $id_rol;
        $conditions['id_rol'] = $id_rol;
    }

    $orderAndLimit = [
        'ORDER' => ['id_rol' => 'DESC'],
        'LIMIT' => [$limit * ($page - 1), $limit]
    ];

    $queryParams = $conditions + $orderAndLimit;

    $roles = $meedo->select('roles', '*', !empty($conditions) ? $queryParams : $orderAndLimit);

    $totalRoles = $meedo->count('roles', !empty($conditions) ? $conditions : []);

    return [
        'status' => true,
        'message' => 'Lista de Roles',
        'data' => [
            'count' => count($roles),
            'total_pages' => ceil($totalRoles / $limit),
            'current_page' => $page,
            'filters' => $filters,
            'profesores' => $roles
        ]
    ];
}

function rolesCreate($request) {
    global $meedo;

    try {
        $nombre = trim($request->get('nombre'));
        $descripcion = trim($request->get('descripcion'));
        $orden = (int)$request->get('orden', 0);

        // Iniciar transacción manualmente
        $meedo->pdo->beginTransaction();

        // Insertar en tabla roles
        $inserted = $meedo->insert('roles', [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'orden' => $orden,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'fecha_actualizacion' => date('Y-m-d H:i:s'),
            'estatus' => 1
        ]);

        if (!$inserted->rowCount()) {
            throw new Exception('Error al insertar el rol en la base de datos.');
        }

        $roleId = $meedo->id(); // Obtener el id del nuevo rol

        $meedo->pdo->commit(); // Confirmar transacción

        $newRole = $meedo->get('roles', '*', ['id_rol' => $roleId]);

        if (!$newRole) {
            throw new Exception('Error al recuperar el rol recién creado.');
        }

        return [
            'status' => true,
            'message' => 'Rol creado exitosamente',
            'data' => [
                'role' => $newRole,
                'id' => $roleId
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
