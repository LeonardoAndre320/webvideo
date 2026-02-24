<?php
//Dependencias do composer/phpmailer
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
//require $_SERVER['DOCUMENT_ROOT'] . 'vendor/autoload.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/db_connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/str.php';

$error = false;
$message = '';
$text = '';

$email;
$code;

//Busca o email relacionado ao código
if (!empty($_COOKIE['code_email'])) {
    $email = $_COOKIE['code_email'];
    $cens_email = censor_string($email, 3);

    try {
        $pdo = database::get_connection();
        $stmt = $pdo->prepare('SELECT * FROM user_pending WHERE email = :email ORDER BY expires_at DESC LIMIT 1');
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            $error = true;
            $message = "Nenhum código esperado para $cens_email";
            return;
        }

        $code = $result['code'];
    } catch (Exception) {
        $error = true;
        $message = "Erro interno.";
    }
    //Evia o código via email
}


// //Envia o email
// $mail = new PHPMailer(true);
// $mail->SMTPDebug = 2;

// try{
//     //Configurações de servidor
//     $mail->isSMTP();
//     $mail->Host = $_ENV['MAIL_HOST'];
//     $mail->SMTPAuth = true;
//     $mail->Username = $_ENV['MAIL_USERNAME'];
//     $mail->Password = $_ENV['MAIL_PASSWORD'];
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//     $mail->Port = $_ENV['MAIL_PORT'];

//     //Destinatario
//     $mail->setFrom($_ENV['MAIL_USERNAME'],'Código de webvideo');
//     $mail->addAddress($email);//email do usuario

//     //Conteudo do email
//     $mail->isHTML(true);
//     $mail->Subject = 'Seu código de verificação';
//     $mail->Body = 'Seu código de verificação é <b>' . $code .'</b><br>Ele expira em 10 minutos.';

//     $mail->send();

//     $text = 'Código de verificação enviado para " ' . $email . ' "';
// }
// catch(Exception)
// {
//     $text = 'Algo deu errado ao enviar seu código de verificação. :(</h3><br><h3>Erro: ' . $mail->ErrorInfo;
// }










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