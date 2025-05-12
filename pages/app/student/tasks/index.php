<?php
define("__DIR_BASE__LOCAL__", dirname(__FILE__) . "./../../../../");
require_once __DIR_BASE__LOCAL__ . "app/Config/env.php";
header("Location: ".BASE_URL."pages/app/student/tasks/status/?v=pending");
exit;
?>
