<?php

// Rutas base y autoload
define('__ROOT_DIR__', realpath(__DIR__ . '/../../../') . '/');
// Archivos del sistema
require_once __ROOT_DIR__ . 'Config/env.php';
require_once __ROOT_DIR__ . 'Database/db.php';
require_once __ROOT_DIR__ . 'Api/V1/Auth/services.php';
require_once __ROOT_DIR__ . 'Api/V1/Auth/validators.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$contentType = $request->headers->get('Content-Type');

if ($contentType !== null && strpos($contentType, 'application/json') === 0) {
    $data = json_decode($request->getContent(), true);
    $request->request->add(is_array($data) ? $data : []);
}

$action = $request->get('action', '');

// Inicializar variables
$statusCodeResponse = 404;
$messageResponse = '----';
$statusResponse = false;
$errorsResponse = [];
$dataResponse = [];
$responseComplete = null;
$contentTypeResponse = 'application/json';
$response = ['status' => $statusResponse, 'message' => $messageResponse, 'data' => $dataResponse];
try {
    switch ($action) {
        case 'login':
            (new HttpMethodGuard())->allowOnly(allowedMethods: ['POST']);
            $errors = validateLogin($request);
            if (!empty($errors)) {
                $statusCodeResponse = 400;
                $statusResponse = false;
                $messageResponse = "Datos inválidos...";
                $errorsResponse = $errors;
                break;
                
            }
            $responseComplete = authLogin($request);
            break;
        default:
            $messageResponse = 'Acción no válida...';
    }
} catch (Exception $e) {
    $statusCodeResponse = 500;
    $messageResponse = 'Error general: ' . $e->getMessage();
}

// Enviar respuesta
if (!$responseComplete) {
    $response = ['status' => $statusResponse, 'message' => $messageResponse, 'data' => $dataResponse ,'_dr'=>$request];
    if ($errorsResponse) {
        $response['errors'] = $errorsResponse;
    }
 
} else {
    $response = $responseComplete;
    if ($errorsResponse) {
        $response['errors'] = $errorsResponse;
    }
    if (isset($responseComplete['status_code'])) {
        $statusCodeResponse = $responseComplete['status_code'];
    }
}
$jsonResponse = new Response(json_encode($response), $statusCodeResponse, [
    'Content-Type' => $contentTypeResponse
]);
$jsonResponse->send();
