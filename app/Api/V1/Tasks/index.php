<?php

// Rutas base y autoload
define('__ROOT_DIR__', realpath(__DIR__ . '/../../../') . '/');
// Archivos del sistema
require_once __ROOT_DIR__ . 'Config/env.php';
require_once __ROOT_DIR__ . 'Database/db.php';
require_once __ROOT_DIR__ . 'Api/V1/Tasks/services.php';
require_once __ROOT_DIR__ . 'Api/V1/Tasks/validators.php';

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
    (new JwtAuthGuard())->requireRoleById(5);

    switch ($action) {
        case 'create':
            (new HttpMethodGuard())->allowOnly(['POST']);
            $errores = validateTaskCreate($request);
            if (!empty($errores)) {
                $statusCodeResponse = 400;
                $statusResponse = false;
                $messageResponse = "Datos inválidos...";
                $errorsResponse = $errores;
                break;
            }
            $responseComplete = taskCreate($request);
            break;

        case 'list':
            (new HttpMethodGuard())->allowOnly(['GET']);
            $responseComplete = taskList($request);
            break;

        case 'edit':
            (new HttpMethodGuard())->allowOnly(['PUT']);
            $errores = validateTaskUpdate($request);
            if (!empty($errores)) {
                $statusCodeResponse = 400;
                $statusResponse = false;
                $messageResponse = "Datos inválidos...";
                $errorsResponse = $errores;
                break;
            }
            $responseComplete = taskUpdate($request);
            break;

        case 'share':
            (new HttpMethodGuard())->allowOnly(['POST']);
            $errores = validateTaskShare($request);
            if (!empty($errores)) {
                $statusCodeResponse = 400;
                $statusResponse = false;
                $messageResponse = "Datos inválidos...";
                $errorsResponse = $errores;
                break;
            }
            $responseComplete = taskShare($request);
            break;

        case 'unshare':
            (new HttpMethodGuard())->allowOnly(['PUT']);
            $errores = validateTaskUnshare($request);
            if (!empty($errores)) {
                $statusCodeResponse = 400;
                $statusResponse = false;
                $messageResponse = "Datos inválidos...";
                $errorsResponse = $errores;
                break;
            }
            $responseComplete = taskUnshare($request);
            break;
        case 'like':
            (new HttpMethodGuard())->allowOnly(['POST']);
            $errores = validateTaskLike($request);
            if (!empty($errores)) {
                $statusCodeResponse = 400;
                $statusResponse = false;
                $messageResponse = "Datos inválidos...";
                $errorsResponse = $errores;
                break;
            }
            $responseComplete = taskLike($request);
            break;

        case 'shared_list':
            (new HttpMethodGuard())->allowOnly(['GET']);
            $responseComplete = taskSharedList($request);
            break;
        case 'feed':
            (new HttpMethodGuard())->allowOnly(['GET']);
            $responseComplete = taskFeedList($request);
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
    $response = ['status' => $statusResponse, 'message' => $messageResponse, 'data' => $dataResponse];
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
