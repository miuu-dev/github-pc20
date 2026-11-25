<?php
class Post
{
    public int $id;
    public string $titulo;
    public string $cuerpo;
    public static $tabla = "posts";

    // constructor
    public function __construct(int $id, string $titulo, string $cuerpo) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->cuerpo = $cuerpo;
    }

    // getters
    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getCuerpo(): string {
        return $this->cuerpo;
    }

    // setters
    public function setTitulo(string $miTitulo) {
        $this->titulo = $miTitulo;
        return $this;
    }

    public function setCuerpo(string $miCuerpo) {
        $this->cuerpo = $miCuerpo;
        return $this;
    }

    /**
     * conseguimos todos los posts que tenemos
     * @return array
     */
    public static function getAll()
    {
        $db = DB::getInstance();
        // Sentencia preparada para prevenir inyección SQL
        $stmt = $db->prepare('SELECT * FROM posts');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * conseguimos el post por su id
     * @param int $id
     */
    public static function getById(int $id)
    {
        $db = DB::getInstance();

        // Sentencia preparada para prevenir inyección SQL
        $stmt = $db->prepare('SELECT * FROM posts WHERE id = :id');

        // Sanitizamos la entrada
        $id = filter_var($id, FILTER_VALIDATE_INT);

        // Vinculamos el parámetro :id 
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        // Obtenemos el post
        $post = $stmt->fetch();

        // Retornamos instancia de Post o null si no existe
        if ($post) {
            return $post;
        } else {
            return null;
        }
    }

    /**
     * actualizamos un post por su id
     * @param int $id
     */
    public function actualizarPost(int $id): bool {
        $db = DB::getInstance();
        $stmt = $db->prepare("UPDATE posts SET title = :titulo, body = :cuerpo WHERE id = :id");

        $stmt->bindValue(':titulo', $this->titulo);
        $stmt->bindValue(':cuerpo', $this->cuerpo);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function crearPost() {
        $db = DB::getInstance();
        $stmt = $db->prepare("INSERT INTO posts (title, body) VALUES (:titulo, :cuerpo");

        $stmt->bindValue(':titulo', $this->titulo);
        $stmt->bindValue(':cuerpo', $this->cuerpo);
        $stmt->execute();

        $this->id = $db->lastInsertId();
        return $stmt->rowCount() > 0;
    }
}
