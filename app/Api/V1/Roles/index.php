<?php

// Rutas base y autoload
define('__ROOT_DIR__', realpath(__DIR__ . '/../../../') . '/');

// Archivos del sistema
require_once __ROOT_DIR__ . 'Config/env.php';
require_once __ROOT_DIR__ . 'Database/db.php';
require_once __ROOT_DIR__ . 'Api/V1/Roles/services.php';
require_once __ROOT_DIR__ . 'Api/V1/Roles/validators.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Crear instancia de Request
$request = Request::createFromGlobals();
$contentType = $request->headers->get('Content-Type');

if ($contentType !== null && strpos($contentType, 'application/json') === 0) {
    $data = json_decode($request->getContent(), true);
    $request->request->add(is_array($data) ? $data : []);
}

$action = $request->get('action', '');

// Inicializar variables
$statusCodeResponse = '404';
$messageResponse = '----';
$statusResponse = false;
$errorsResponse = [];
$dataResponse = [];
$responseComplete = null;
$contentTypeResponse = 'application/json';
$response = ['status' => $statusResponse, 'message' => $messageResponse, 'data' => $dataResponse];
try {
    switch ($action) {
        case 'list':
            (new HttpMethodGuard())->allowOnly(['GET']);
            $errors = validateListRoles($request, $meedo);
            if (!empty($errors)) {
                $statusCodeResponse = 400;
                $statusResponse = false;
                $messageResponse = "Datos inválidos...";
                $errorsResponse = $errors;
                break;
            }
            $statusCodeResponse = 200;
            $responseComplete = rolesIndex($request);
            break;

            case 'create':
                (new HttpMethodGuard())->allowOnly(['POST']);
                $errors = validateCreateRoles($request, $meedo);
                if (!empty($errors)) {
                    $statusCodeResponse = 400;
                    $statusResponse = false;
                    $messageResponse = "Datos inválidos...";
                    $errorsResponse = $errors;
                    break;
                }
                $statusCodeResponse = 200;
                $responseComplete = rolesCreate($request);
                break;
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
}
$jsonResponse = new Response(json_encode($response), $statusCodeResponse, [
    'Content-Type' => $contentTypeResponse
]);
$jsonResponse->send();