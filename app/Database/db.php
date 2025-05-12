<?php
if (!defined('__ROOT_DIR__')) {
    define('__ROOT_DIR__', realpath(__DIR__ . '/../') . '/');
}

require_once __ROOT_DIR__ . 'vendor/autoload.php';

use Medoo\Medoo;

$host    = defined('DB_HOST')     ? DB_HOST     : 'http://127.0.0.1/';
$db      = defined('DB_NAME')     ? DB_NAME     : 'bd';
$user    = defined('DB_USER')     ? DB_USER     : 'root';
$pass    = defined('DB_PASSWORD') ? DB_PASSWORD : '';
$charset = defined('DB_CHARSET')  ? DB_CHARSET  : 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $meedo = new Medoo([
        'database_type' => 'mysql',
        'pdo' => $pdo,
    ]);

    $GLOBALS['MEEDO_PDO'] = $meedo;

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => false,
        'message' => 'Error de conexión a la base de datos',
        'error' => $e->getMessage()
    ]);
    exit;
}
