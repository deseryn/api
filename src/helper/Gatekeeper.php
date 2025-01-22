use Firebase\JWT\JWT;
use Firebase\JWT\Key;

<?php

namespace App\Helper;

class Gatekeeper
{
    private const AUDIENCES = ['audience1', 'audience2']; // Add your audiences here
    private const SUBJECTS = ['subject1', 'subject2']; // Add your subjects here
    private $secretKey;

    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function isAuthorized(string $jwt): bool
    {
        try {
            $decoded = JWT::decode($jwt, new Key($this->secretKey, 'HS256'));

            if (!in_array($decoded->aud, self::AUDIENCES)) {
                return false;
            }

            if (!in_array($decoded->sub, self::SUBJECTS)) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
