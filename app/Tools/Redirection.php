<?php

class Redirection {
    public static function to($url, $message = null, $messageType = '') {
        try {
            if (!is_null($message)) {
                session_start();
                $_SESSION['message'] = $message;
                $_SESSION['message_type'] = $messageType;
            }
    
            // Limpia los posibles dobles slashes
            $base = rtrim(BASE_URL, '/');
            $path = ltrim($url, '/');
    
            // Redirige limpio
            header("Location: {$base}/{$path}");
            exit();
        } catch (Exception $e) {
            error_log("Error in Redirection::to: " . $e->getMessage(), 0);
        }
    }
    

    public static function back($defaultUrl = '/') {
        try {
            $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;

            // Si no hay Referer o es el mismo script, redirige a la URL por defecto
            if (!$referer || parse_url($referer, PHP_URL_PATH) == $_SERVER['SCRIPT_NAME']) {
                self::to($defaultUrl);
            }

            // Realiza la redirección hacia atrás
            header("Location: $referer");
            exit();
        } catch (Exception $e) {
            // Registra el error en un archivo de registro
            error_log("Error in Redirection::back: " . $e->getMessage(), 0);
        }
    }

    public static function with($url, $data = []) {
        try {
            session_start();

            foreach ($data as $key => $value) {
                $_SESSION[$key] = $value;
            }

            // Realiza la redirección
            header("Location: " . BASE_URL . "/$url");
            exit();
        } catch (Exception $e) {
            // Registra el error en un archivo de registro
            error_log("Error in Redirection::with: " . $e->getMessage(), 0);
        }
    }

}
?>
