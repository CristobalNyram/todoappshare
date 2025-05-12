<?php
class PermissionManager {
    private $db;

    public function __construct($meedo) {
        $this->db = $meedo;
    }

    public function getRolesAndPermissionsByUserId($user_id) {
        // 1. Get user role IDs
        $role_ids = $this->db->select('usuarios_roles', 'id_rol', [
            'id_usuario' => $user_id
        ]);

        if (empty($role_ids)) {
            return [
                'roles' => [],
                'permissions' => []
            ];
        }

        // 2. Get role info (id + name)
        $roles = $this->db->select('roles', ['id_rol', 'nombre'], [
            'id_rol' => $role_ids
        ]);

        // 3. Get permission IDs from roles
        $permission_ids = $this->db->select('roles_plataforma_permisos', 'id_permiso', [
            'id_rol' => $role_ids,
            'estatus' => 1
        ]);

        // 4. Remove duplicates
        $unique_permission_ids = array_unique($permission_ids);

        // 5. Get permission keys
        $permission_keys = [];
        if (!empty($unique_permission_ids)) {
            $permission_keys = $this->db->select('plataforma_permisos', 'clave', [
                'id_permiso' => $unique_permission_ids
            ]);
        }

        return [
            'roles' => $roles,                            // [{ id_rol: 1, nombre: "Admin" }, ...]
            'permissions' => $permission_keys             // ["permiso1", "permiso2", ...]
        ];
    }
}
