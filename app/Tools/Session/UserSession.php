<?php

class UserSession extends SessionManager
{
    private const USER_KEY = 'auth_payload';

    // Guarda el payload completo del usuario (ej. extraído del JWT o login)
    public static function login(array $payload): void
    {
        self::set(self::USER_KEY, $payload);
    }

    // Elimina toda la sesión
    public static function logout(): void
    {
        self::remove(self::USER_KEY);
        self::destroy();
    }

    // Verifica si el usuario está logueado (payload presente y no expirado)
    public static function isAuthenticated(): bool
    {
        $payload = self::get(self::USER_KEY);
    
        // Si no hay sesión, no está autenticado
        if (!$payload) return false;
    
        // Si tiene fecha de expiración y ya caducó
        if (isset($payload['exp']) && $payload['exp'] <= time()) {
            // ⚠️ Eliminar payload y cerrar sesión
            self::logout(); // esto elimina el payload y destruye la sesión
            return false;
        }
    
        return true;
    }
    

    // Obtener el payload completo
    public static function getPayload(): ?array
    {
        if (!self::isAuthenticated()) {
            return null;
        }
        return self::get(self::USER_KEY);
    }
    

    // Obtener datos básicos de usuario
    public static function getUser(): ?array
    {
        $payload = self::getPayload();
        return $payload['usuario'] ?? null;
    }

    // Obtener el ID del usuario
    public static function getUserId(): ?int
    {
        $payload = self::getPayload();
        return $payload['sub'] ?? null;
    }

    // Verificar si tiene un permiso
    public static function hasPermission(string $key): bool
    {
        $payload = self::getPayload();
        return isset($payload['permisos']) && in_array($key, $payload['permisos']);
    }
    public static function hasAnyPermission(array $permissions): bool
    {
        $userPermissions = self::getPermissions();
        foreach ($permissions as $perm) {
            if (in_array($perm, $userPermissions)) {
                return true;
            }
        }
        return false;
    }


    // Verificar si tiene un rol por ID
    public static function hasRole(int|string $role): bool
    {
        foreach (self::getRoles() as $rol) {
            if (is_array($rol)) {
                if ((is_int($role) && $rol['id_rol'] == $role) ||
                    (is_string($role) && isset($rol['nombre']) && strtolower($rol['nombre']) === strtolower($role))
                ) {
                    return true;
                }
            } elseif (is_object($rol)) {
                if ((is_int($role) && $rol->id_rol == $role) ||
                    (is_string($role) && isset($rol->nombre) && strtolower($rol->nombre) === strtolower($role))
                ) {
                    return true;
                }
            }
        }

        return false;
    }


    public static function getRoles(): array
    {
        return self::getPayload()['roles'] ?? [];
    }

    public static function getPermissions(): array
    {
        return self::getPayload()['permisos'] ?? [];
    }
    public static function isStudent(): bool
    {
        return self::hasRole(5);
    }

    public static function isAdmin(): bool
    {
        return self::hasRole(2);
    }

    public static function isSuperAdmin(): bool
    {
        return self::hasRole(1);
    }

    public static function isTeacher(): bool
    {
        return self::hasRole(4);
    }


    //validar que si el usuario tiene un rol al menos
    public static function hasAnyRole(): bool
    {
        $roles = self::getRoles();
        return !empty($roles);
    }

    public static function countRoles(): int
    {
        return count(self::getRoles());
    }

    // Verificar si SOLO tiene un rol específico
    public static function hasOnlyRole(int|string $role): bool
    {
        $roles = self::getRoles();
        if (count($roles) !== 1) {
            return false;
        }
        return self::hasRole($role);
    }

    public static function hasExactlyRole(int|string $role): bool
    {
        $roles = self::getRoles();
        if (count($roles) !== 1) {
            return false;
        }
        return self::hasRole($role);
    }

    public static function getAlumno(): ?array
    {
        return self::getUser()['alumno'] ?? null;
    }

    public static function getProfesor(): ?array
    {
        return self::getUser()['profesor'] ?? null;
    }

    public static function addToPayload(string $path, $value): void
    {
        $payload = self::getPayload(); // Obtener el payload actual

        $keys = explode('.', $path);
        $current = &$payload;

        foreach ($keys as $key) {
            if (!isset($current[$key]) || !is_array($current[$key])) {
                $current[$key] = [];
            }
            $current = &$current[$key];
        }

        $current = $value;

        // Guardar otra vez en sesión utilizando SessionManager
        SessionManager::set(self::USER_KEY, $payload);
    }
}
