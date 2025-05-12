<?php
$__USER__ = null;
$__ACTIVE_URL__ = "logout";
define("__ACTIVE_URL__", $__ACTIVE_URL__);
define("__DIR_BASE__LOCAL__", dirname(__FILE__) . "./../../../");

require_once(__DIR_BASE__LOCAL__ . "/app/Config/env.php");

UserSession::start();

if (UserSession::isAuthenticated()) {
    UserSession::logout(); 
}

echo "
<script>
    localStorage.removeItem('Tk');
    window.location.href = '" . BASE_URL . "pages/auth/login/';
</script>
";
exit;
