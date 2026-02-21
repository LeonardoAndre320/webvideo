<?php
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="main_bar">
        <h2 id="lbl_title_page">Web Video</h2>
    </header>

    <main>
        <button id="btn_login">Login</button>
        <button id="btn_register">Cadrastrar</button>
        <br>
        <input id="txt_email" type="text" placeholder="E-mail">
        <br>
        <input id="txt_password" type="password" placeholder="Senha">
        <br>
        <label id="lbl_forgot_password">
            <input type="checkbox" name="forgot_password" id="ckb_forgot_password">
            Esqueci minha senha
        </label>

        <br>
        <button id="btn_continue">Continuar</button>
    </main>

    <script src="/scripts/warnings.js"></script>
    <script src="script.js"></script>

</body>

</html>