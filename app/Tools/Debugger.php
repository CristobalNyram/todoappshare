<?php

class Debugger {
    public static function dd($variable) {
        error_log(print_r($variable, true));
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
        exit();
    }
}

?>
