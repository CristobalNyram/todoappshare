<?php
class PasswordManager {
    private static $cost = 12;

    // Permite establecer un nuevo costo si lo necesitas
    public static function setCost($newCost) {
        self::$cost = $newCost;
    }

    // Encripta una contraseña
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => self::$cost]);
    }

    // Verifica una contraseña contra su hash
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}
