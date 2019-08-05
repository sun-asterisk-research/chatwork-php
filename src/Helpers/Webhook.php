<?php

namespace SunAsterisk\Chatwork\Helpers;

class Webhook
{
    public static function verifySignature(string $token, string $body, string $signature)
    {
        $secret = base64_decode($token);
        $digest = hash_hmac('sha256', $body, $secret, true);
        $expectedSignature = base64_encode($digest);

        return hash_equals($expectedSignature, $signature);
    }
}
