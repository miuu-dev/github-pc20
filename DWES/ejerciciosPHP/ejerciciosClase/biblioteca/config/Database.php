<?php
class Database {
    # variables privadas para poder usarlas dentro de la siguiente función, de la clase Database
    private $host = 'localhost';
    private $db_name = 'biblioteca_db';
    private $user = 'root';
    private $pwd = '';
    private $conn;

    # función para poder conectarnos a la base de datos
    public function getConexion() {
        $this->conn = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->user, $this->pwd,[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }

        return $this->conn;
    }
}