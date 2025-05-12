<?php
function InfoStundentMe()
{
    global $meedo;
    try {
        UserSession::start();
        $usuario = UserSession::getUser();
        $alumno=$usuario['alumno'] ?? null;
        if (empty($alumno)) {
            return [
                'status' => false,
                'status_code' => 404,
                'message' => 'No se encontró tu información',
                'data' => $usuario
            ];
        }
        $id_alumno = $alumno['id_alumno'] ?? null;;
        if (empty($id_alumno)) {
            return [
                'status' => false,
                'status_code' => 404,
                'message' => 'No se encontró tu información',
                'data' => $usuario
            ];
        }

        $alumno = $meedo->select('alumnos', '*', ['id_alumno' => $id_alumno]);
        if (empty($alumno)) {
            return [
                'status' => false,
                'status_code' => 404,
                'message' => 'No se encontró tu información',
                'data' => $usuario
            ];
        }
        return [
            'status' => true,
            'status_code' => 200,
            'message' => 'Información del alumno',
            'data' => $alumno[0]
        ];
    } catch (\Throwable $th) {
        return [
            'status' => false,
            'status_code' => 500,
            'message' => 'Error al obtener la información del alumno',
            'data' => null
        ];
    }
}
