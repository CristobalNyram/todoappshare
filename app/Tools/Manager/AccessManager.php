<?php

class AccessManager
{
    private static string $secret = 'access_key_default';

    /**
     * Inicializa la clave secreta para encriptar/desencriptar
     * @param string $paramSecret Clave opcional
     * @param bool $forceParam Si es true, se ignora la constante ACCESS_SECRET y se usa $paramSecret
     */
    public static function init(string $paramSecret = '', bool $forceParam = false): void
    {
        if (defined('JWT_SECRET') && !$forceParam) {
            self::$secret = JWT_SECRET;
        } elseif (!empty($paramSecret)) {
            self::$secret = $paramSecret;
        }
        // Si no hay constante ni parámetro, se queda con el valor por defecto
    }

    // 🔐 Encriptar datos (string o array)
    public static function encrypt(array|string $data): string
    {
        $json = is_array($data) ? json_encode($data) : $data;
        $iv = random_bytes(16);
        $cipherText = openssl_encrypt($json, 'AES-256-CBC', self::$secret, 0, $iv);
        return base64_encode($iv . $cipherText);
    }

    // 🔓 Desencriptar y devolver array|string|null
    public static function decrypt(string $encoded): array|string|null
    {
        $raw = base64_decode($encoded);
        $iv = substr($raw, 0, 16);
        $cipherText = substr($raw, 16);
        $decrypted = openssl_decrypt($cipherText, 'AES-256-CBC', self::$secret, 0, $iv);

        $jsonDecoded = json_decode($decrypted, true);
        return json_last_error() === JSON_ERROR_NONE ? $jsonDecoded : $decrypted;
    }

    // 🔍 Validar permiso específico
    public static function hasPermission(array $permissions, string $key): bool
    {
        return in_array($key, $permissions);
    }

    // 🔍 Validar rol específico por ID
    public static function hasRole(array $roles, int $id): bool
    {
        foreach ($roles as $rol) {
            if (is_array($rol) && isset($rol['id_rol']) && $rol['id_rol'] == $id) {
                return true;
            } elseif (is_object($rol) && isset($rol->id_rol) && $rol->id_rol == $id) {
                return true;
            }
        }
        return false;
    }
}
