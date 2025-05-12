<?php

class AlumnoManager
{
    private $db;

    public function __construct($meedo)
    {
        $this->db = $meedo;
    }

    public function getAlumnoByUsuarioId(int $id_usuario): ?array
    {
        $alumno = $this->db->get('alumnos', '*', [
            'id_usuario' => $id_usuario
        ]);

        return $alumno ?: null;
    }
}
