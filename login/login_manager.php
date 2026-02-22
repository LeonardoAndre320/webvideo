<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/db_connection.php';
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

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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

    $hash = 'SENHA VINDO DO BANCO';

    if (password_verify($password, $hash)) {
        //Senha certa
    } else {
        //Senha errada
    }

}

function register($args = [])
{
    $email = trim($args['email'] ?? '');
    $password = trim($args['password'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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

    //SENHA PARA HASH
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $pdo = database::get_connection();

    $code = 0;

    $expires_at = date('Y-m-d H:i:s', time() + 600); // 10 minutos


    $stmt = $pdo->prepare('INSERT INTO user_pending (email, pass_hash, code, expires_at) VALUES (:email,:pass_hash,:code,:expires_at)');
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':pass_hash', $hash);
    $stmt->bindValue(':code', $code);
    $stmt->bindValue(':expires_at', $expires_at);
    $stmt->execute();

}

//Envio final
echo json_encode($response);