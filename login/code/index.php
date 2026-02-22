<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/db_connection.php';
session_start();

if (!isset($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = time();
}

if (time() - $_SESSION['last_activity'] >= 600) {
    session_destroy();
}

$email = $_SESSION['email'] ?? '';
$hash = $_SESSION['hash'] ?? '';
$text;
$code;

if ($email !== '' && $hash !== '') {

    //Gera um novo código de 6 digitos
    $pdo = database::get_connection();
    do {
        $code = random_int(100000, 999999);
        $stmt = $pdo->prepare('SELECT code FROM user_pending where code = :code');
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } while (!empty($result));

    

} else {
    $text = 'Algo deu errado :(';
}









?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code</title>

    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <main>
        <h3><?php echo $text; ?></h3>
        <br>
        <input id="txt_code" type="text" placeholder="Código">
        <br>
        <button id="btn_resend">Reenviar</button>

        <button id="btn_continue">Continuar</button>
    </main>

    <script src="script.js"></script>
</body>

</html>