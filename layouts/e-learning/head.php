<?php
if (!defined('__ACTIVE_PAGE_NAME__')) {
    define("__ACTIVE_PAGE_NAME__", "Home");
}
if (!defined('APP_VERSION')) {
    define("APP_VERSION", 0);
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JavaScript de configuración -->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>app/Config/env.js?v=<?php echo APP_VERSION; ?>"></script>

    <!-- Título y favicon -->
    <title><?php echo __ACTIVE_PAGE_NAME__; ?> | <?php echo PROYECTO_NOMBRE; ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo FAVICON_1; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo FAVICON_1; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo FAVICON_1; ?>">
    <link rel="manifest" href="<?php echo FAVICON; ?>">

    <!-- Tipografías e iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS base -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/main.css">

    <!-- Plugins y librerías -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/file-upload.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/plyr.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/editor-quill.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/full-calendar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/calendar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/apexcharts.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/jquery-jvectormap-2.0.5.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/libs/data-tables.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/libs/responsive-data-tables.min.css">

    <!-- Estilos personalizados para la tabla -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/e-learning/assets/css/botones-datatables.css">
</head>