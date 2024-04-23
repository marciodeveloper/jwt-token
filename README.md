# JWT Token

# JwtManager Class Documentation

O código selecionado define uma classe PHP chamada `JwtManager` dentro do namespace `Josemarciobarthem\JwtToken`. Esta classe é projetada para gerenciar JSON Web Tokens (JWTs), que são um meio compacto e seguro para URL de representar reivindicações a serem transferidas entre duas partes. A classe fornece funcionalidades para criar, validar e decodificar JWTs.

## Propriedades

- `private $secretKey;`: Uma propriedade privada que armazena a chave secreta usada para assinar os tokens. Esta chave é crucial para a segurança dos tokens, garantindo que apenas partes com acesso à chave secreta possam criar ou validar os tokens.

## Métodos

### `__construct($secretKey)`
O método construtor recebe um parâmetro `$secretKey` e o atribui à propriedade `secretKey`. Esta chave é usada no algoritmo de hashing para assinar os tokens.

### `createToken($payload)`
Este método é responsável por criar um JWT. Ele recebe um array `$payload` como entrada, que representa as reivindicações do token. O método realiza os seguintes passos:
1. Codifica o cabeçalho (especificando o algoritmo HS256 e tipo de token JWT) e o payload em formato Base64Url.
2. Cria uma assinatura ao hashear o cabeçalho codificado e o payload com a chave secreta usando o algoritmo HMAC SHA256.
3. Codifica a assinatura em formato Base64Url.
4. Concatena o cabeçalho codificado, o payload e a assinatura com pontos (.) para formar o token completo.

### `base64UrlEncode($data)`
Um método privado que codifica dados em formato Base64Url, que é uma versão segura para URL do Base64 padrão. Ele substitui + por -, / por _, e remove os caracteres de preenchimento =.

### `base64UrlDecode($data)`
Um método privado que decodifica dados do formato Base64Url de volta à sua forma original. Ele reverte as transformações feitas por `base64UrlEncode`.

### `validateToken($token)`
Este método valida um JWT dado. Ele divide o token em seus componentes (cabeçalho, payload e assinatura), decodifica a assinatura e então a compara com uma nova assinatura gerada com base no cabeçalho e payload do token. Retorna verdadeiro se as assinaturas coincidirem, indicando que o token é válido, ou falso caso contrário.

### `decodeToken($token)`
Este método decodifica um JWT dado e retorna seu payload como um array associativo. Ele divide o token, decodifica o payload do formato Base64Url e então decodifica o payload JSON.

## Resumo

A classe `JwtManager` encapsula a funcionalidade necessária para trabalhar com JWTs em uma aplicação PHP, incluindo a criação de tokens com reivindicações específicas, validando a autenticidade dos tokens e decodificando tokens para extrair seu payload. Esta implementação depende do algoritmo HMAC SHA256 para assinar tokens, que é um método amplamente utilizado e seguro para JWTs.

