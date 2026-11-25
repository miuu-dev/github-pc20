<?php
class Libro
{
    # variables para realizar la conexión
    private PDO $conn;
    private string $tabla = 'libros';

    # variables de la clase Libro
    public $id;
    public $titulo;
    public $autor;
    public $genero;
    public $anio_publicacion;
    public $leido;
    public $usuario_id;
    public $fecha_creacion;

    /**
     * función que sirve para poder conectarnos a la base de datos
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    /**
     * creación de un nuevo libro e insertado en la base de datos
     * @return bool true si se insertó correctamente
     */
    public function crear()
    {
        $sql = "insert into " . $this->tabla . " (titulo, autor, genero, año_publicacion, leido, usuario_id) VALUES (:titulo, :autor, :genero, :anio, :leido, :usuario_id)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':genero', $this->genero);
        $stmt->bindParam(':anio', $this->anio_publicacion);
        $stmt->bindParam(':leido', $this->leido);
        $stmt->bindParam(':usuario_id', $this->usuario_id);

        $ok = $stmt->execute();

        if ($ok) {
            $this->id = $this->conn->lastInsertId();
        }

        return $ok;
    }

    /**
     * obtiene todos los libros de un usuario
     * @param mixed $uid id del usuario logueado
     * @return bool lista de libros
     */
    public function obtenerPorUsuario($uid)
    {
        $sql = "select * from " . $this->tabla . " where usuario_id = :uid order by id desc";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':uid', $uid);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * obtener el libro por su id unicamente
     * @param mixed $id
     * @param mixed $uid
     */
    public function obtenerPorId($id, $uid)
    {
        $sql = "select * from " . $this->tabla . " where id = :id and usuario_id = :uid";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':uid', $uid);

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * actualizar los datos del libro dicho y que sea sí o sí del usuario logueado
     * @return bool true si se actualizó correctamente
     */
    public function actualizar()
    {
        $sql = "update " . $this->tabla . " set titulo = :titulo, autor = :autor, genero = :genero, año_publicacion = :anio, leido = :leido where id = :id and usuario_id = :uid";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':genero', $this->genero);
        $stmt->bindParam(':anio', $this->anio_publicacion);
        $stmt->bindParam(':leido', $this->leido);
        $stmt->bindParam(':uid', $this->usuario_id);

        return $stmt->execute();
    }

    /**
     * elimina el libro solo si pertenece al usuario
     * @return bool true si se ha borrado correctamente
     */
    public function eliminar()
    {
        $sql = "delete from " . $this->tabla . " where id = :id and usuario_id = :uid";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':uid', $this->usuario_id);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    /**
     * devuelve un libro por id, sin filtrar al propietario
     * GET /api/libros/{$id}
     * @param mixed $id
     */
    public function obtenerPorIdSinFiltro($id)
    {
        $sql = "select * from " . $this->tabla . " where id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * devuevle todos los libros de todos los usuarios
     * GET /api/libros
     * @return array
     */
    public function obtenerTodos()
    {
        $sql = "select * from " . $this->tabla . " order by id desc";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * transfiere un libro a otro usuario, aunque no pertenezca al usuario actual
     * @param mixed $id
     * @param mixed $new_user
     * @return bool true si se transfirió correctamente
     */
    public function transferirF($id, $new_user)
    {
        $sql = "update " . $this->tabla . " set usuario_id = :new_user where id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':new_user', $new_user);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    /**
     * transfiere un libro a otro usuario solo si pertenece al usuario actual
     * @param mixed $id
     * @param mixed $new_user
     * @return bool true si se transfirió correctamente
     */
    public function transferirD($id, $new_user, $user)
    {
        $sql = "update " . $this->tabla . " set usuario_id = :new_user where id = :id and usuario_id = :user";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':new_user', $new_user);
        $stmt->bindParam(':user', $user);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}
