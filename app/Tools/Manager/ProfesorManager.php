<?php

class ProfesorManager
{
    private $db;

    public function __construct($meedo)
    {
        $this->db = $meedo;
    }

    public function getProfesorByUsuarioId(int $id_usuario): ?array
    {
        $profesor = $this->db->get('profesores', '*', [
            'id_usuario' => $id_usuario
        ]);

        return $profesor ?: null;
    }
}
