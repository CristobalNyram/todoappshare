<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtAuthGuard
{
    private $token;
    private $payload;
    private $secret;

    /**
     * @param string $secretParam Clave alternativa (si no se usa la constante)
     * @param bool $forceParam Si es true, usa $secretParam aunque JWT_SECRET esté definida
     */
    public function __construct(string $secretParam = 'default', bool $forceParam = false)
    {
        // Usar JWT_SECRET si está definida y no se fuerza el parámetro
        if (defined('JWT_SECRET') && !$forceParam) {
            $this->secret = JWT_SECRET;
        } else {
            $this->secret = $secretParam;
        }

        $this->token = $this->extractTokenFromHeader();

        if (!$this->token) {
            $this->respondAndExit('Token no proporcionado.', 'authorization');
        }

        try {
            $this->payload = JWT::decode($this->token, new Key($this->secret, 'HS256'));
        } catch (ExpiredException $e) {
            $this->respondAndExit('Token expirado.', 'authorization', $e->getMessage());
        } catch (SignatureInvalidException $e) {
            $this->respondAndExit('Token con firma inválida.', 'authorization', $e->getMessage());
        } catch (BeforeValidException $e) {
            $this->respondAndExit('Token aún no válido (nbf o iat futuro).', 'authorization', $e->getMessage());
        } catch (UnexpectedValueException $e) {
            $this->respondAndExit('Token inválido.', 'authorization', $e->getMessage());
        } catch (Exception $e) {
            $this->respondAndExit('Error al procesar token.', 'authorization', $e->getMessage());
        }
    }

    private function extractTokenFromHeader(): ?string
    {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';
    
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return $matches[1];
        }
    
        return null;
    }

    private function respondAndExit(string $message, string $context = 'permission', string $debug = ''): void
    {
        http_response_code(403);
        header('Content-Type: application/json');

        echo json_encode([
            'status' => false,
            'message' => $message,
            'data' => [
                '_context' => $context,
                // 'http' =>  $_SERVER['HTTP_AUTHORIZATION'] ?? null,
                // 'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
                // 'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
                // 'request_uri' => $_SERVER['REQUEST_URI'] ?? null,
                // 'request_method' => $_SERVER['REQUEST_METHOD'] ?? null,
                // 'request_headers' => getallheaders(),
            ],
            'debug' => $debug
        ]);
        exit;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function requirePermission(string $requiredKey): void
    {
        $permissions = $this->payload->permisos ?? [];
        if (!in_array($requiredKey, $permissions)) {
            $this->respondAndExit("No tienes permiso para acceder a '{$requiredKey}'.", 'permission');
        }
    }

    public function requireRoleById(int $requiredRoleId): void
    {
        $roles = $this->payload->roles ?? [];

        foreach ($roles as $rol) {
            if (isset($rol->id_rol) && $rol->id_rol == $requiredRoleId) {
                return;
            }
        }

        $this->respondAndExit("Acceso denegado. Requiere rol con ID: {$requiredRoleId}.", 'role');
    }
}
