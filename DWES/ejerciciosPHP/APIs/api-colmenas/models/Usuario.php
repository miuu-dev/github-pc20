<?php

class Usuario {
    // conexión a la bbdd
    private $conn;
    // nombre de la tabla
    private $table_name  = "usuarios";

    // propiedades del objeto Usuario
    public int $id;
    public string $username;
    public string $nombre_completo;
    public string $email;
    public string $fecha_registro;

    /**
     * Constructor
     * @param PDO $db Conexión a la base de datos
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Obtiene todos los usuarios
     * ENDPOINT: GET /usuarios
     * @return bool|PDOStatement | false
     */
    public function obtenerTodos() {
        $query  ="SELECT
                    id,
                    username,
                    nombre_completo,
                    email,
                    fecha_registro
                    FROM " . $this->table_name . "ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    /**
     * Obtiene un usuario por su ID
     * ENDPOINT: GET /usuarios/{id}
     * @param int $id ID del usuario
     * @return bool true si se encontró, false si no
     */
    public function obtenerPorId(int $id) {
        $query = "SELECT
                    id,
                    username,
                    nombre_completo,
                    email,
                    fecha_registro 
                    FROM " . $this->table_name ." WHERE id = :id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt -> rowCount() > 0) {
            $row = $stmt->fetch();

            // asignar valores a las propiedades del objeto
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->nombre_completo = $row['nombre_completo'];
            $this->email = $row['email'];
            $this->fecha_registro = $row['fecha_registro'];

            return true;
        }

        return false;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . "
        SET username = :username,
        nombre_completo = :nombre_completo,
        email = :email";

        $stmt = $this->conn->prepare($query);

        // limpiar y validar datos
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->nombre_completo = htmlspecialchars(strip_tags($this->nombre));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // bind de parámetros
        $stmt->bindParam(':username', $this->username);
    }
}

?>