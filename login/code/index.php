<?php
//Dependencias do composer/phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require $_SERVER['DOCUMENT_ROOT'] . 'vendor/autoload.php';

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

    //Envia o email
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 2;

    try{
        //Configurações de servidor
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['MAIL_PORT'];

        //Destinatario
        $mail->setFrom($_ENV['MAIL_USERNAME'],'Código de webvideo');
        $mail->addAddress($email);//email do usuario

        //Conteudo do email
        $mail->isHTML(true);
        $mail->Subject = 'Seu código de verificação';
        $mail->Body = 'Seu código de verificação é <b>' . $code .'</b><br>Ele expira em 10 minutos.';

        $mail->send();

        $text = 'Código de verificação enviado para " ' . $email . ' "';
    }
    catch(Exception)
    {
        $text = 'Algo deu errado ao enviar seu código de verificação. :(</h3><br><h3>Erro: ' . $mail->ErrorInfo;
    }

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