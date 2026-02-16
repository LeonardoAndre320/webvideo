<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>upload</title>

    <link rel="stylesheet" href="/styles/main.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <header>
        <h2 id="lbl_title_page">Web Video</h2>
    </header>

    <main>
        <h2>Upload:</h2>

        <p>Arquivo do video: (max:100mb)</p>
        <input type="file" accept="video/mp4, video/webm, video/ogg, video/quicktime, video/x-msvideo">
        <p>Arquivo para thumbnail</p>
        <input type="file" accept="image/jpeg, image/png, image/gif, image/webp, image/svg+xml">
        <p>Nome do video:</p>
        <input type="text">
        <p>Descrição do video</p>
        <input type="text">
        <br>
        <label>
            <input type="radio" name="visibility" value="public">
            Publico
        </label>
        <br>
        <label>
            <input type="radio" name="visibility" value="private">
            Privado
        </label>
    </main>

    <script src="script.js"></script>
</body>

</html>