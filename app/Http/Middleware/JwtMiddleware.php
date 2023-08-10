<?php
namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = JWTAuth::getToken();
        
        if (!$token) {
            return response()->json(['error' => 'Token no proporcionado'], 401);
        }

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido'], 401);
        }

        // Verifica si el token está a punto de expirar (por ejemplo, en los últimos 10 minutos)
        $exp = JWTAuth::parseToken()->getPayload()->get('exp');
        $now = time();
        $refreshThreshold = config('jwt.refresh_threshold', 600); // 10 minutos en segundos
        
        if ($exp - $now < $refreshThreshold) {
            // Genera un nuevo token con una nueva fecha de expiración
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
            $response = $next($request);
            return $response->header('Authorization', 'Bearer ' . $newToken);
        }

        return $next($request);
    }
}
