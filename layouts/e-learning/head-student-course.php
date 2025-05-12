<?php
if (!defined('__ACTIVE_PAGE_NAME__')) {
    define("__ACTIVE_PAGE_NAME__", "Home");
}
if (!defined('APP_VERSION')) {
    define("APP_VERSION", 0);
}
?>

<head>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>app/Config/env.js?v=<?php echo APP_VERSION; ?>"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title><?php echo __ACTIVE_PAGE_NAME__; ?> | <?php echo PROYECTO_NOMBRE; ?></title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo FAVICON_1; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo FAVICON_1; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo FAVICON_1; ?>">
    <link rel="manifest" href="<?php echo FAVICON; ?>">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/bootstrap.min.css">
    <!-- file upload -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/file-upload.css">
    <!-- file upload -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/plyr.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- full calendar -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/full-calendar.css">
    <!-- jquery Ui -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/jquery-ui.css">
    <!-- editor quill Ui -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/editor-quill.css">
    <!-- apex charts Css -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/apexcharts.css">
    <!-- calendar Css -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/calendar.css">
    <!-- jvector map Css -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/jquery-jvectormap-2.0.5.css">
    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/main.css">

        <!-- Custom css -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/custom/custom.css">
    
</head>