<?php

class JwtManager
{
    private $secretKey;
    public function __construct($secretkey)
    {
        $this->secretKey = $secretkey;
    }
    public function createToken($payload)
    {
        $base64UrlHeader = $this->base64UrlEncode(json_encode(["alg" => "HS256", "type" => "JWT"]));
        $base64UrlPayload = $this->base64UrlEncode(json_encode($payload));
        $base64Signature = hash_hmac('sha256', $base64UrlHeader. ".". $base64UrlPayload, $this->secretKey, true);
        $base64UrlSignature = $this->base64UrlEncode($base64Signature);
        return $base64UrlHeader. ".". $base64UrlPayload. ".". $base64UrlSignature;
    }

    private function base64UrlEncode($data)
    {
        $base64 = base64_encode($data);
        $base64Url = strtr($base64, '+/', '-_');
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64UrlDecode($data)
    {
        $base64 = strtr($data, '-_', '+/');
        $base64Padded = str_pad($base64, strlen($base64) % 4,"=", STR_PAD_RIGHT);
        return base64_decode($base64Padded);
    }
    public function validateToken($token)
    {
        // Validação do token para implementação do JWT
        list($base64UrlHeader, $base64UrlPayload, $base64UrlSignature) = explode('.', $token);

        $signature = $this->base64UrlDecode ($base64UrlSignature);
        $expectedSignature = hash_hmac('sha256', $base64UrlHeader . ".". $base64UrlPayload, $this->secretKey, true);

        return hash_equals($signature, $expectedSignature);

    }
    public function decodeToken($token)
    {
        // Implementation for decoding JWT
        list(, $base64UrlPayload, ) = explode('.', $token);
        $payload = $this->base64UrlDecode($base64UrlPayload);
        return json_decode($payload, true);
    }

}