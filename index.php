<?php
// Inclusão da classe JWT
require 'vendor/autoload.php';
use JwtManager;

// Definição da chave secreta
$secretKey = '';

// Criação do objeto JWTManager
$jwtManager = new JwtManager($secretKey);

// Criação do token
$payload = [
    'user_id' => 1,
    'username' => 'Morten Gamst',
    'exp' => time() + 3600,
];
$jwt = $jwtManager->createToken($payload);
echo "Token JWT: " . $jwt . PHP_EOL;

// Validação do token
if ($jwtManager->validateToken($jwt)) {
    echo "Token válido". PHP_EOL;
} else {
    echo "Token inválido". PHP_EOL;
}

