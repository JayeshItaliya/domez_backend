<?php

namespace App\Services;

use Firebase\JWT\JWT;

class JwtService
{
    public function generateClientSecret(string $clientId, string $teamId, string $keyId, string $privateKey): string
    {
        $time = time();
        $payload = [
            'iss' => $teamId,
            'iat' => $time,
            'exp' => $time + (86400 * 180), // 180 days expiration
            'aud' => 'https://appleid.apple.com',
            'sub' => $clientId,
        ];
        $headers = [
            'kid' => $keyId,
            'alg' => 'ES256',
        ];
        $clientSecret = JWT::encode($payload, $privateKey, 'ES256', $keyId, $headers);
        return $clientSecret;
    }
}
