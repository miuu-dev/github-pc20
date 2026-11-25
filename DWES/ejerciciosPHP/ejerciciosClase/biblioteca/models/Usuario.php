<?php
class Usuario {
    # variables para realizar la conexión
    private PDO $conn;
    private string $tabla = 'usuarios';

    # propiedades de la clase Usuario
    public $id;
    public $email;
    public $nombre;
    public $password;
    public $fecha_registro;

    /**
     * función que sirve para poder conectarnos a la base de datos
     * @param PDO $db
     */
    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    /**
     * creación de usuario y hasheando la contraseña
     * @return bool true si se ha creado correctamente
     */
    public function crear() {
        $sql = "insert into " . $this->tabla . " (email, nombre, password) values (:email, :nombre, :password)";
        $stmt = $this->conn->prepare($sql);

        $hash = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':password', $hash);

        return $stmt->execute();
    }

    /**
     * función para poder comprobar que el email que hemos introducido existe o no
     * @param string $email
     * @return bool true si ya existe (1), false si no (0)
     */
    public function existeEmail(string $email) {
        $sql = "select count(*) from " . $this->tabla . " where email = :email";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    /**
     * función para poder buscar por email a los usuarios
     * @param string $email
     */
    public function buscarPorEmail(string $email) {
        $sql = "select id, email, nombre, password from " . $this->tabla . " where email = :email";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $fila = $stmt->fetch();

        return $fila;
    }
}
