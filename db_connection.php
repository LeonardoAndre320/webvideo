<?php
require_once __DIR__ . '/../config.php';

class database
{
    private static $instance = null;

    public static function get_connection()
    {
        //Se uma instancia já existe, retorna ele sem reconsultar
        if (self::$instance === null) {
            //Se não existe o ambiente com os dados do banco
            if (!isset($_ENV['DB_HOST'])) {
                load_env(__DIR__ . '/../.data.env');
            }

            try {
                $host = $_ENV['DB_HOST'];
                $db = $_ENV['DB_NAME'];
                $user = $_ENV['DB_USER'];
                $pass = $_ENV['DB_PASS'];

                self::$instance = new PDO(
                    "mysql:host=$host;dbname=$db;charset=utf8mb4",
                    $user,
                    $pass,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]

                );
            }
            catch(PDOException $e)
            {
                die();
            }
        }
        return self::$instance;
    }
}