<?php
header('Content-Type: application/json');//Cabeçalho da resposta json

$input = json_decode('php://input', true);
$func = $input['func'] ?? null;
$args = $input['args'] ?? [];

//Resposta padrão
$response = [
    'status' => 'error',
    'message' => 'Invalid function',
    'data' => null
];

//Funções permitidas
$allowed_functions = [
    'login',
    'register'
];

//Chamada de funções
if ($func && in_array($func, $allowed_functions)) {//Se existe e esta na lista
    try {
        $response = call_user_func($func, $args);//Chama a função e o retorno dela vai para $response
    } catch (Exception) {
        $response = [
            'status' => 'error',
            'message' => 'Internal server error',
            'data' => null
        ];
    }
}

function login($args = [])
{
    $email = trim($args['email'] ?? '');
    $password = trim($args['password'] ?? '');
    $forgot = $args['forgot'] ?? false;

    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        return [
            'status' => 'error',
            'message' => 'Email not valid',
            'data' => $email
        ];
    }

    if (!is_bool($forgot)) {
        return [
            'status' => 'error',
            'message' => 'forgot is not boolean',
            'data' => $forgot
        ];
    }

    if ($password === '' && !$forgot) {
        return [
            'status' => 'error',
            'message' => 'password not valid',
            'data' => $password
        ];
    }
}

function register($args = [])
{
    $email = trim($args['email'] ?? '');
    $password = trim($args['password'] ?? '');

    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        return [
            'status' => 'error',
            'message' => 'Email not valid',
            'data' => $email
        ];
    }

    if ($password === '') {
        return [
            'status' => 'error',
            'message' => 'password not valid',
            'data' => $password
        ];
    }
}

//Envio final
echo json_encode($response);