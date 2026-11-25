<?php
class Conexion
{
    private string $host;
    private string $user;
    private string $password;
    private string $dbname;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->user = 'root';
        $this->password = '';
        $this->dbname = 'bdconducir';
    }

    public function connect()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
        // 1. Establecer la conexión PDO (Esta parte ya la tenías perfecta)
        $pdo = new PDO($dsn, $this->user, $this->password);
        // Configuración para lanzar excepciones
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
?>