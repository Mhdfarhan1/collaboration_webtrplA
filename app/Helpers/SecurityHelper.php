<?php

namespace App\Helpers;

class SecurityHelper
{
    /**
     * Encode numeric ID to a secure, unguessable, URL-safe cryptographic token
     */
    public static function encode($id): string
    {
        if (is_null($id) || $id === '') return '';
        $secret = config('app.key', 'webkelas_secret_key');
        $hash = substr(hash_hmac('sha256', (string)$id, $secret), 0, 8);
        $token = (string)$id . '-' . $hash;
        return rtrim(strtr(base64_encode($token), '+/', '-_'), '=');
    }

    /**
     * Decode secure URL-safe token back to numeric ID
     */
    public static function decode($encoded)
    {
        if (is_null($encoded) || $encoded === '') return null;
        
        $base64 = strtr((string)$encoded, '-_', '+/');
        $padding = strlen($base64) % 4;
        if ($padding) {
            $base64 .= str_repeat('=', 4 - $padding);
        }
        
        $decoded = @base64_decode($base64, true);
        if (!$decoded || !str_contains($decoded, '-')) {
            // Fallback to integer if raw numeric ID is passed
            return is_numeric($encoded) ? (int)$encoded : null;
        }

        $parts = explode('-', $decoded, 2);
        if (count($parts) !== 2) {
            return is_numeric($encoded) ? (int)$encoded : null;
        }

        list($id, $hash) = $parts;
        $secret = config('app.key', 'webkelas_secret_key');
        $expectedHash = substr(hash_hmac('sha256', (string)$id, $secret), 0, 8);

        if (hash_equals($expectedHash, $hash)) {
            return (int)$id;
        }

        return is_numeric($encoded) ? (int)$encoded : null;
    }
}
