<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function authLogin($request)
{
    global $meedo;

    $email = trim($request->get('email'));
    $password = $request->get('password');

    try {
        $user = $meedo->get('usuarios', '*', [
            'usuario' => $email
        ]);

        if (!$user) {
            return [
                'status' => false,
                'status_code' => 404,
                'message' => 'El usuario no existe.',
                'data' => []
            ];
        }
        // 🚨 Validar si el usuario está inactivo
        if (isset($user['estatus']) && (int) $user['estatus'] == 0) {
            return [
                'status' => false,
                'status_code' => 403,
                'message' => 'Tu cuenta está inactiva. Por favor, contacta al administrador.',
                'data' => []
            ];
        }

        if (!PasswordManager::verifyPassword($password, $user['contrasenia'])) {
            return [
                'status' => false,
                'status_code' => 404,
                'message' => 'Credenciales inválidas.',
                'password' => PasswordManager::hashPassword($password),
                'data' => []
            ];
        }

        $permissionManager = new PermissionManager($meedo);
        $access = $permissionManager->getRolesAndPermissionsByUserId($user['id_usuario']);
        if (empty($access['roles'])) {
            return [
                'status' => false,
                'status_code' => 403,
                'message' => 'Tu cuenta no tiene roles asignados. Contacta al administrador.',
                'data' => []
            ];
        }

        // Crear token JWT
        $payload = [
            'sub' => $user['id_usuario'],
            'usuario' => [
                'nombre' => $user['nombre'],
                'paterno' => $user['paterno'],
                'usuario' => $user['usuario']
            ],
            'roles' => $access['roles'],
            'permisos' => $access['permissions'],
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + (60 * 60 * 24)
        ];

        $secret = defined('JWT_SECRET') ? JWT_SECRET : 'errror';
        $token = JWT::encode($payload, $secret, 'HS256');
        $redirectTo = BASE_URL . 'pages/app/dashboard/';
        $alumnoData = [];
        $profesorData = [];
        // 🔐 Guardar en sesión
        UserSession::login($payload);
        // Cargar datos de alumno o profesor SIEMPRE si tiene esos roles
        if (UserSession::hasRole(5)) { // Tiene rol de Alumno
            $alumnoManager = new AlumnoManager($meedo);
            $alumnoData = $alumnoManager->getAlumnoByUsuarioId($user['id_usuario']) ?? [];
            UserSession::addToPayload('usuario.alumno', $alumnoData);
        }

        if (UserSession::hasRole(4)) { // Tiene rol de Profesor
            $profesorManager = new ProfesorManager($meedo);
            $profesorData = $profesorManager->getProfesorByUsuarioId($user['id_usuario']) ?? [];
            UserSession::addToPayload('usuario.profesor', $profesorData);
        }

        // Ahora decidir a dónde redireccionarlo
        if (UserSession::hasRole(1) || UserSession::hasRole(2)) {
            // Si tiene rol de SuperAdmin o Admin
            $redirectTo = BASE_URL . 'pages/app/management/dashboard/';
        } elseif (UserSession::hasExactlyRole(5)) {
            // Solo Alumno
            $redirectTo = BASE_URL . 'pages/app/student/tasks/status/?v=pending';
        } elseif (UserSession::hasExactlyRole(4)) {
            // Solo Profesor
            $redirectTo = BASE_URL . 'pages/app/teacher/dashboard/';
        } else {
            // Otro tipo de usuario
            $redirectTo = BASE_URL . 'pages/app/dashboard/';
        }



        return [
            'status' => true,
            'status_code' => 200,
            'message' => 'Inicio de sesión exitoso.',
            'data' => [
                'redirect_to' => $redirectTo,
                'token' => $token,
                'roles' => $access['roles'],
                'permissions' => $access['permissions'],
                'user' => [
                    'id' => $user['id_usuario'],
                    'nombre' => $user['nombre'],
                    'usuario' => $user['usuario'],
                    'estatus' => $user['estatus'],
                    'fecha_creacion' => $user['fecha_creacion'],
                    'alumno' => $alumnoData,
                    'profesor' => $profesorData,

                ]
            ]
        ];
    } catch (Exception $e) {
        return [
            'status' => false,
            'status_code' => 500,
            'message' => 'Error de servidor.',
            'data' => [],
            'errors' => ['exception' => $e->getMessage()]
        ];
    }
}
