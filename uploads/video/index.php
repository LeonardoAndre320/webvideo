<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Titulo</title>

    <link rel="stylesheet" href="/styles/main.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <header>
        <h2 id="lbl_title_page">Web Video</h2>
    </header>

    <main>
        <div class="controls">
            <h2>Opções</h2>
            <p>Titulo:</p>
            <input type="text">
            <p>Descrição:</p>
            <input type="text">
            <p>Thumbnail:</p>
            <input type="file" accept="image/jpeg, image/png, image/gif, image/webp, image/svg+xml">
            <p></p>
            <label>
                <input type="radio" name="visibility" value="public">
                Publico
            </label>
            <br>
            <label>
                <input type="radio" name="visibility" value="private">
                Privado
            </label>
            <br>
            <button>Salvar</button>
        </div>
        <div class="statistics">
            <h2>Estatisticas</h2>
            <p>Status:Processando</p>
            <p>Visualizações:123</p>
            <p>Aprovação:50%</p>
            <p>Likes:123</p>
            <p>Dislikes:123</p>
            <p>Comentarios:123</p>
        </div>
    </main>

    <footer>

    </footer>

    <script src="script.js"></script>
</body>

</html>