<?php
function load_env($path)
{
    if (!file_exists($path)) {
        return false;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {

        $line = trim($line);

        // Ignora comentários
        if ($line === '' || strpos($line, '#') === 0) {
            continue;
        }

        // Garante que existe "="
        if (!str_contains($line, '=')) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);

        $name  = trim($name);
        $value = trim($value);

        // Remove aspas se existirem
        $value = trim($value, '"\''); 

        if (!array_key_exists($name, $_ENV) && !array_key_exists($name, $_SERVER)) {
            putenv("$name=$value");
            $_ENV[$name] = $value; 
            $_SERVER[$name] = $value;
        }
    }

    return true;
}

load_env(__DIR__ . '/../data.env');