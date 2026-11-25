<?php
class Usuario {
    //variables
    public int $id;
    public string $usuario;
    public string $pwd;

    // constructor
    public function __construct(int $id, string $usuario, string $pwd) 
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->pwd  =$pwd;
    }

    // getters
    public function getId(): int {
        return $this->id;
    }
    public function getUsuario(): string {
        return $this->usuario;
    }
    public function getPwd(): string {
        return $this->pwd;
    }

    // setters
    public function setId(int $miId): void {
        $this->id = $miId;
    }
    public function setUsuario(string $miUsuario): void {
        $this->usuario = $miUsuario;
    }
    public function setPwd(string $miPwd): void {
        $this->pwd = $miPwd;
    }

    // creación de usuario
    /**
     * Código para poder crear un nuevo usuario
     * @return bool
     */
    public function registerUsuario() {
        $pwd_cifrado = password_hash($this->pwd, PASSWORD_DEFAULT);

        // realizamos la conexión
        $db = DB::getInstance();
        $sql_insert = "INSERT INTO usuarios (usuario, pwd) VALUES (:usuario, :pwd)";
        $stmt = $db->prepare($sql_insert);

        $stmt->bindValue(':usuario', $this->usuario);
        $stmt->bindValue(':pwd', $pwd_cifrado);

        $stmt->execute();

        $this->id = $db->lastInsertId();
        return $stmt->rowCount() > 0;
    }

    public function loginUsuario(string $usuario, string $pwd): bool {
        // realizamos la conexión
        $db = DB::getInstance();

        // buscamos la contraseña para el usuario
        $sql_select = "SELECT pwd FROM usuarios WHERE usuario = :usuario";

        // permiten consultar la base de datos de forma segura
        $stmt = $db->prepare($sql_select);
        $stmt->bindValue(':usuario', $usuario);
        $stmt->execute();

        // obtenemos el resultado
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        // devuelve false si las credenciales no coinciden
        if(!$fila) {
            return false;
        }

        // compara la contraseña que escribe la persona con el hash guardado
        return password_verify($pwd, $fila['pwd']);
    }
}