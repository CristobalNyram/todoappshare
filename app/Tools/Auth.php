<?php

class Auth {

    public static function isUserLoggedIn() {
        
        if (!isset($_SESSION)) {
            session_start();
        }
        return isset($_SESSION['usuario']);
    }

    public static function requireLogin() {
        // error_log(BASE_URL);
        if (!self::isUserLoggedIn()) {
            header("Location: " . BASE_URL . "/login.php");
            exit();
        }
    }

}

?>
