<?php
function permissionsIndex($request) {
    global $meedo;

    $page = (int)$request->get('page', 1);
    $limit = (int)$request->get('limit', 100);
    $filters = [
        'limit' => $limit,
        'page' => $page
    ];
    $id_permiso = $request->get('id_permiso', null);

    // FILTROS
    $conditions = [];
    if (!empty($id_permiso)) {
        $filters['id_permiso'] = $id_permiso;
        $conditions['id_permiso'] = $id_permiso;
    }

    $orderAndLimit = [
        'ORDER' => ['id_permiso' => 'DESC'],
        'LIMIT' => [$limit * ($page - 1), $limit]
    ];

    $queryParams = $conditions + $orderAndLimit;

    $permisos = $meedo->select('plataforma_permisos', '*', !empty($conditions) ? $queryParams : $orderAndLimit);

    $totalPermisos = $meedo->count('plataforma_permisos', !empty($conditions) ? $conditions : []);

    return [
        'status' => true,
        'message' => 'Lista de Permisos',
        'data' => [
            'count' => count($permisos),
            'total_pages' => ceil($totalPermisos / $limit),
            'current_page' => $page,
            'filters' => $filters,
            'profesores' => $permisos
        ]
    ];
}

function permissionsCreate($request) {
    global $meedo;

    try {
        $id_rol = trim($request->get('id_rol'));
        $id_permiso = trim($request->get('id_permiso'));
        $estatus = (int)$request->get('estatus', 1);

        // Iniciar transacción manualmente
        $meedo->pdo->beginTransaction();

        // Insertar en tabla roles_plataforma_permisos
        $inserted = $meedo->insert('roles_plataforma_permisos', [
            'id_rol' => $id_rol,
            'id_permiso' => $id_permiso,
            'estatus' => $estatus,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'fecha_actualizacion' => date('Y-m-d H:i:s'),
        ]);

        if (!$inserted->rowCount()) {
            throw new Exception('Error al insertar el permiso en la base de datos.');
        }

        $permisoId = $meedo->id(); // Obtener el id del nuevo permiso

        $meedo->pdo->commit(); // Confirmar transacción

        $newPermiso = $meedo->get('roles_plataforma_permisos', '*', ['id_rol_permiso' => $permisoId]);

        if (!$newPermiso) {
            throw new Exception('Error al recuperar el permiso recién creado.');
        }

        return [
            'status' => true,
            'message' => 'Permiso creado exitosamente',
            'data' => [
                'permiso' => $newPermiso,
                'id' => $permisoId
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

?>