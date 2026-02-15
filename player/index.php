<?php
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player</title>

    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="main_bar">
        <h2 id="lbl_title_page">Web Video</h2>

        <input type="text" id="txt_main_search">

        <button id="btn_main_search">Buscar</button>

        <button id="btn_main_login">Login</button>
    </header>

    <main>
        <div class="player_box">
            <img src="https://s2-techtudo.glbimg.com/tCQFQnzLiVbpQ5oPf5YzBTVS59w=/0x0:695x422/1000x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_08fbf48bc0524877943fe86e43087e7a/internal_photos/bs/2021/f/T/lrtrqfRmONtmlRaNv5BA/2015-04-07-media-player-classic.jpg" width="100%" height="100%">
        </div>

        <div class="video_options">
            <h2>Teste de titulo</h2>
            <p>Descrição do video onde tem um resumo do conteudo.</p>
            <div class="interaction_bar">
                <h2 id="lbl_chanel_name">Canal 123</h2>
                <button id="btn_subscribe">Se inscrever</button>
                <button id="btn_like">Like</button>
                <button id="btn_dislike">Dislike</button>
                <button id="btn_share">Compartilhar</button>
                <button id="btn_report">Denunciar</button>
            </div>
        </div>

        <div class="comments">
            <div class="own_comment">
                <p>Deixe seu comentario:</p>
                <input type="text" id="txt_own_comment">
                <button>Salvar</button>
            </div>
            <div class="comment_block">
                <h3>Nome do usuario</h3>
                <p>comentario</p>
            </div>
        </div>
    </main>

    <script src="script.js"></script>
</body>

</html>