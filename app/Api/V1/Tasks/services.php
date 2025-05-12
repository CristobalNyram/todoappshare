<?php

function taskCreate($request)
{
    global $meedo;

    UserSession::start();
    $user = UserSession::getUser();
    $student = $user['alumno'] ?? null;

    if (empty($student)) {
        return [
            'status' => false,
            'status_code' => 403,
            'message' => 'No se encontró la información del alumno.',
            'data' => [],
            $student
        ];
    }

    $id_alumno = $student['id_alumno'];

    $data = [
        'id_alumno' => $id_alumno,
        'titulo' => $request->get('titulo'),
        'descripcion' => $request->get('descripcion', null),
        'completada' => false
    ];

    try {
        $meedo->insert('tareas', $data);
        $id = $meedo->id();

        return [
            'status' => true,
            'status_code' => 201,
            'message' => 'Tarea creada correctamente.',
            'data' => ['id_tarea' => $id]
        ];
    } catch (Exception $e) {
        return [
            'status' => false,
            'status_code' => 500,
            'message' => 'Error al crear la tarea.',
            'errors' => ['exception' => $e->getMessage()],
            'data' => []
        ];
    }
}



function taskUpdate($request)
{
    global $meedo;

    UserSession::start();
    $user = UserSession::getUser();
    $student = $user['alumno'] ?? null;

    if (empty($student)) {
        return [
            'status' => false,
            'status_code' => 403,
            'message' => 'No se encontró la información del alumno.',
            'data' => [],
            $student
        ];
    }

    $id_alumno = $student['id_alumno'];
    $id_tarea = $request->get('id_tarea');

    $task = $meedo->get('tareas', '*', ['id_tarea' => $id_tarea]);

    if (!$task) {
        return [
            'status' => false,
            'status_code' => 404,
            'message' => 'Tarea no encontrada.',
            'data' => []
        ];
    }

    if ($task['id_alumno'] != $id_alumno) {
        return [
            'status' => false,
            'status_code' => 403,
            'message' => 'No tienes permiso para modificar esta tarea.',
            'data' => []
        ];
    }

    $fields = [];
    if ($request->get('titulo') !== null) {
        $fields['titulo'] = $request->get('titulo');
    }
    if ($request->get('descripcion') !== null) {
        $fields['descripcion'] = $request->get('descripcion');
    }
    if ($request->get('completada') !== null) {
        $fields['completada'] = filter_var($request->get('completada'), FILTER_VALIDATE_BOOLEAN);
    }

    if (empty($fields)) {
        return [
            'status' => false,
            'status_code' => 400,
            'message' => 'No se proporcionaron campos para actualizar.',
            'data' => []
        ];
    }

    try {
        $meedo->update('tareas', $fields, ['id_tarea' => $id_tarea]);

        return [
            'status' => true,
            'status_code' => 200,
            'message' => 'Tarea actualizada correctamente.',
            'data' => ['id_tarea' => $id_tarea]
        ];
    } catch (Exception $e) {
        return [
            'status' => false,
            'status_code' => 500,
            'message' => 'Error al actualizar la tarea.',
            'errors' => ['exception' => $e->getMessage()],
            'data' => []
        ];
    }
}


function taskList($request)
{
    global $meedo;

    UserSession::start();
    $user = UserSession::getUser();
    $student = $user['alumno'] ?? null;

    if (empty($student)) {
        return [
            'status' => false,
            'status_code' => 404,
            'message' => 'No se encontró la información del alumno.',
            'data' => $user,
            'alumno'=>$user
        ];
    }

    $id_alumno = $student['id_alumno'];

    $page = max(1, (int)$request->get('page', 1));
    $limit = max(1, (int)$request->get('limit', 10));
    $offset = ($page - 1) * $limit;

    $titulo = $request->get('titulo', null);
    $descripcion = $request->get('descripcion', null);

    $filters = [
        'limit' => $limit,
        'page' => $page
    ];

    $conditions = ['t.id_alumno' => $id_alumno];

    if (!empty($titulo)) {
        $filters['titulo'] = $titulo;
        $conditions['t.titulo[~]'] = $titulo;
    }

    if (!empty($descripcion)) {
        $filters['descripcion'] = $descripcion;
        $conditions['t.descripcion[~]'] = $descripcion;
    }

    $estado = $request->get('completada', null);
    if ($estado !== null && $estado !== '') {
        $filters['completada'] = (int)$estado;
        $conditions['t.completada'] = (int)$estado;
    }

    try {
        $totalTasks = $meedo->count('tareas', ['id_alumno' => $id_alumno]);

        $filteredTasks = $meedo->count('tareas (t)', [
            '[>]tareas_compartidas (tc)' => ['t.id_tarea' => 'id_tarea']
        ], 't.id_tarea', $conditions);

        $tasks = $meedo->select('tareas (t)', [
            '[>]tareas_compartidas (tc)' => ['t.id_tarea' => 'id_tarea']
        ], [
            't.id_tarea',
            't.titulo',
            't.descripcion',
            't.completada',
            't.fecha_creacion',
            't.fecha_actualizacion',
            'tc.activa',
            'tc.id_tarea(id_compartida)'
        ], [
            'LIMIT' => [$offset, $limit],
            'ORDER' => ['t.id_tarea' => 'DESC'],
            ...$conditions
        ]);

        // Agregar flag 'compartida'
        $tasks = array_map(function ($task) {
            $task['compartida'] = isset($task['id_compartida']) && $task['activa'] == 1;
            unset($task['id_compartida'], $task['activa']);
            return $task;
        }, $tasks);


        return [
            'status' => true,
            'status_code' => 200,
            'message' => 'Lista de tareas obtenida correctamente.',
            'filters' => $filters,
            'records_total' => $totalTasks,
            'records_filtered' => $filteredTasks,
            'total_pages' => ceil($filteredTasks / $limit),
            'current_page' => $page,
            'data' => $tasks
        ];
    } catch (Exception $e) {
        return [
            'status' => false,
            'status_code' => 500,
            'message' => 'Error al obtener las tareas.',
            'errors' => ['exception' => $e->getMessage()],
            'data' => []
        ];
    }
}


function taskShare($request)
{
    global $meedo;
    UserSession::start();
    $user = UserSession::getUser();
    $student = $user['alumno'] ?? null;

    if (!$student) {
        return [
            'status' => false,
            'status_code' => 403,
            'message' => 'No se encontró tu información.',
            'data' => []
        ];
    }

    $id_alumno = $student['id_alumno'];
    $id_tarea = $request->get('id_tarea');

    $tarea = $meedo->get('tareas', '*', ['id_tarea' => $id_tarea, 'id_alumno' => $id_alumno]);
    if (!$tarea) {
        return [
            'status' => false,
            'status_code' => 404,
            'message' => 'Tarea no encontrada o no te pertenece.',
            'data' => []
        ];
    }

    // Verificar si ya está compartida
    $yaCompartida = $meedo->get('tareas_compartidas', '*', [
        'id_tarea' => $id_tarea,
        'id_alumno' => $id_alumno
    ]);

    if ($yaCompartida) {
        if ((bool)$yaCompartida['activa'] === true) {
            return [
                'status' => false,
                'status_code' => 400,
                'message' => 'Esta tarea ya está compartida actualmente.',
                'data' => ['id_tarea_compartida' => $yaCompartida['id_tarea_compartida']]
            ];
        }

        // Reactivar si estaba inactiva y actualizar fecha
        $meedo->update('tareas_compartidas', [
            'activa' => true,
            'fecha_compartida' => date('Y-m-d H:i:s')
        ], ['id_tarea_compartida' => $yaCompartida['id_tarea_compartida']]);

        return [
            'status' => true,
            'status_code' => 200,
            'message' => 'Tarea compartida reactivada.',
            'data' => ['id_tarea_compartida' => $yaCompartida['id_tarea_compartida']]
        ];
    }

    // Crear nueva tarea compartida
    $meedo->insert('tareas_compartidas', [
        'id_tarea' => $id_tarea,
        'id_alumno' => $id_alumno,
        'fecha_compartida' => date('Y-m-d H:i:s')
    ]);

    $id = $meedo->id();
    return [
        'status' => true,
        'status_code' => 201,
        'message' => 'Tarea compartida correctamente.',
        'data' => ['id_tarea_compartida' => $id]
    ];
}



function taskUnshare($request)
{
    global $meedo;
    UserSession::start();
    $user = UserSession::getUser();
    $student = $user['alumno'] ?? null;

    if (!$student) {
        return [
            'status' => false,
            'status_code' => 403,
            'message' => 'No se encontró tu información.',
            'data' => []
        ];
    }

    $id_alumno = $student['id_alumno'];
    $id_tarea = $request->get('id_tarea');

    $tareaCompartida = $meedo->get('tareas_compartidas', '*', [
        'id_tarea' => $id_tarea,
        'id_alumno' => $id_alumno
    ]);

    if (!$tareaCompartida) {
        return [
            'status' => false,
            'status_code' => 404,
            'message' => 'Tarea compartida no encontrada o no es tuya.',
            'data' => ['id_tarea' => $id_tarea, 'id_alumno' => $id_alumno]
        ];
    }

    $meedo->update('tareas_compartidas', ['activa' => false], [
        'id_tarea_compartida' => $tareaCompartida['id_tarea_compartida']
    ]);

    return [
        'status' => true,
        'status_code' => 200,
        'message' => 'Tarea compartida desactivada correctamente.',
        'data' => ['id_tarea' => $id_tarea]
    ];
}


function taskLike($request)
{
    global $meedo;
    UserSession::start();
    $user = UserSession::getUser();
    $student = $user['alumno'] ?? null;

    if (!$student) {
        return [
            'status' => false,
            'status_code' => 403,
            'message' => 'No se encontró tu información.',
            'data' => []
        ];
    }

    $id_alumno = $student['id_alumno'];
    $id_tarea_compartida = $request->get('id_tarea_compartida');

    // Verificar existencia y estado de la tarea compartida
    $tareaCompartida = $meedo->get('tareas_compartidas', '*', [
        'id_tarea_compartida' => $id_tarea_compartida,
        'activa' => true
    ]);

    if (!$tareaCompartida) {
        return [
            'status' => false,
            'status_code' => 404,
            'message' => 'La tarea compartida no existe o no está activa.',
            'data' => []
        ];
    }

    // Verificar si ya dio like
    $yaDioLike = $meedo->get('tareas_likes', '*', [
        'id_tarea_compartida' => $id_tarea_compartida,
        'id_alumno' => $id_alumno
    ]);

    if ($yaDioLike) {
        return [
            'status' => false,
            'status_code' => 400,
            'message' => 'Ya has dado like a esta tarea.',
            'data' => []
        ];
    }

    try {
        $meedo->insert('tareas_likes', [
            'id_tarea_compartida' => $id_tarea_compartida,
            'id_alumno' => $id_alumno
        ]);

        return [
            'status' => true,
            'status_code' => 201,
            'message' => 'Like registrado correctamente.',
            'data' => []
        ];
    } catch (Exception $e) {
        return [
            'status' => false,
            'status_code' => 500,
            'message' => 'Error al registrar el like.',
            'errors' => ['exception' => $e->getMessage()],
            'data' => []
        ];
    }
}



function taskSharedList($request)
{
    global $meedo;
    UserSession::start();
    $user = UserSession::getUser();
    $student = $user['alumno'] ?? null;
    $id_alumno = $student['id_alumno'] ?? null;

    $page = max(1, (int)$request->get('page', 1));
    $limit = max(1, (int)$request->get('limit', 10));
    $offset = ($page - 1) * $limit;

    $titulo = $request->get('titulo', null);

    $filters = [
        'limit' => $limit,
        'page' => $page
    ];

    // Solo tareas compartidas por el usuario logueado y activas
    $conditions = [
        'tareas_compartidas.activa' => true,
        'tareas_compartidas.id_alumno' => $id_alumno
    ];

    if (!empty($titulo)) {
        $filters['titulo'] = $titulo;
        $conditions['tareas.titulo[~]'] = $titulo;
    }

    try {
        $total = $meedo->count('tareas_compartidas', $conditions);

        $tareas = $meedo->select('tareas_compartidas', [
            '[>]tareas' => ['id_tarea' => 'id_tarea'],
            '[>]alumnos' => ['id_alumno' => 'id_alumno']
        ], [
            'tareas_compartidas.id_tarea_compartida',
            'tareas.titulo',
            'tareas.descripcion',
            'tareas.completada',
            'tareas.fecha_creacion',
            'tareas.fecha_actualizacion',
            'tareas_compartidas.fecha_compartida(compartida_at)',
            'alumnos.nombre',
            'alumnos.apellido_p'
        ], [
            'LIMIT' => [$offset, $limit],
            'ORDER' => ['tareas_compartidas.id_tarea_compartida' => 'DESC'],
            'AND' => $conditions
        ]);

        $filtered = count($tareas);

        // Agregar likes
        foreach ($tareas as &$tarea) {
            $tarea['likes'] = $meedo->count('tareas_likes', [
                'id_tarea_compartida' => $tarea['id_tarea_compartida']
            ]);

            $tarea['liked_by_me'] = $id_alumno
                ? (bool) $meedo->has('tareas_likes', [
                    'id_tarea_compartida' => $tarea['id_tarea_compartida'],
                    'id_alumno' => $id_alumno
                ])
                : false;
        }

        return [
            'status' => true,
            'status_code' => 200,
            'message' => 'Lista de tareas compartidas obtenida correctamente.',
            'data' => $tareas,
            'filters' => $filters,
            'records_total' => $total,
            'records_filtered' => $filtered
        ];
    } catch (Exception $e) {
        return [
            'status' => false,
            'status_code' => 500,
            'message' => 'Error al obtener las tareas compartidas.',
            'errors' => ['exception' => $e->getMessage()],
            'data' => []
        ];
    }
}


function taskFeedList($request)
{
    global $meedo;
    UserSession::start();
    $user = UserSession::getUser();
    $student = $user['alumno'] ?? null;
    $id_alumno = $student['id_alumno'] ?? null;

    $page = max(1, (int)$request->get('page', 1));
    $limit = max(1, (int)$request->get('limit', 10));
    $offset = ($page - 1) * $limit;

    $titulo = $request->get('titulo', null);

    $filters = [
        'limit' => $limit,
        'page' => $page
    ];

    $conditions = [
        'tareas_compartidas.activa' => true,
        'tareas_compartidas.id_alumno[!]' => $id_alumno
    ];

    if (!empty($titulo)) {
        $filters['titulo'] = $titulo;
        $conditions['tareas.titulo[~]'] = $titulo;
    }

    try {
        $tareas = $meedo->select('tareas_compartidas', [
            '[>]tareas' => ['id_tarea' => 'id_tarea'],
            '[>]alumnos' => ['id_alumno' => 'id_alumno']
        ], [
            'tareas_compartidas.id_tarea_compartida',
            'tareas.titulo',
            'tareas.descripcion',
            'tareas.descripcion',
            'tareas.fecha_creacion',
            'tareas.fecha_actualizacion',
            'tareas_compartidas.fecha_compartida(compartida_at)',
            'tareas.completada',
            'alumnos.nombre',
            'alumnos.apellido_p',
        ], [
            'LIMIT' => [$offset, $limit],
            'ORDER' => ['tareas_compartidas.id_tarea_compartida' => 'DESC'],
            'AND' => $conditions
        ]);

        $filtered = count($tareas);
        $total = $meedo->count('tareas_compartidas', [
            'activa' => true,
            'id_alumno[!]' => $id_alumno
        ]);

        foreach ($tareas as &$tarea) {
            $tarea['likes'] = $meedo->count('tareas_likes', [
                'id_tarea_compartida' => $tarea['id_tarea_compartida']
            ]);

            $tarea['liked_by_me'] = $meedo->has('tareas_likes', [
                'id_tarea_compartida' => $tarea['id_tarea_compartida'],
                'id_alumno' => $id_alumno
            ]);
        }

        return [
            'status' => true,
            'status_code' => 200,
            'message' => 'Feed de tareas compartidas por otros alumnos obtenido correctamente.',
            'data' => $tareas,
            'filters' => $filters,
            'records_total' => $total,
            'records_filtered' => $filtered
        ];
    } catch (Exception $e) {
        return [
            'status' => false,
            'status_code' => 500,
            'message' => 'Error al obtener el feed.',
            'errors' => ['exception' => $e->getMessage()],
            'data' => []
        ];
    }
}
