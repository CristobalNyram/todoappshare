<?php

class HttpMethodGuard
{
    private $allowedMethods = [];

    public function allowOnly(array $allowedMethods): void
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'POST');
        $this->allowedMethods = array_map('strtoupper', $allowedMethods);

        if (!in_array($method, $this->allowedMethods)) {
            $this->respondAndExit();
        }
    }

    private function respondAndExit(): void
    {
        http_response_code(405);
        header('Content-Type: application/json');
        header('Allow: ' . implode(', ', $this->allowedMethods));

        echo json_encode([
            'status' => false,
            'message' => 'Error de validación.',
            'data' => [
                '_method_current' => $_SERVER['REQUEST_METHOD'] ?? 'POST',
                '_method' => 'Método no permitido. Se esperaba: ' . implode(', ', $this->allowedMethods)
            ]
        ]);
        exit;
    }
}
