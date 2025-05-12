<?php

use Symfony\Component\HttpFoundation\Session\Session;

class SessionManager
{
    private static ?Session $session = null;

    // Inicializar sesión
    public static function start(): void
    {
        if (!self::$session) {
            self::$session = new Session();
            self::$session->start();
        }
    }

    // Establecer valor
    public static function set(string $key, mixed $value): void
    {
        self::start();
        self::$session->set($key, $value);
    }

    // Obtener valor
    public static function get(string $key, mixed $default = null): mixed
    {
        self::start();
        return self::$session->get($key, $default);
    }

    // Eliminar valor
    public static function remove(string $key): void
    {
        self::start();
        self::$session->remove($key);
    }

    // Verificar si existe
    public static function has(string $key): bool
    {
        self::start();
        return self::$session->has($key);
    }

    // Limpiar toda la sesión
    public static function clear(): void
    {
        self::start();
        self::$session->clear();
    }

    // Finalizar la sesión (logout total)
    public static function destroy(): void
    {
        if (self::$session) {
            self::$session->invalidate();
            self::$session = null;
        }
    }

    // Para usar en views o debug
    public static function all(): array
    {
        self::start();
        return self::$session->all();
    }
}
