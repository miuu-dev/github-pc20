<?php
require_once("Conexion.php");
class Conductor
{
    // ---- VARIABLES ----
    public int $id;
    public string $nombre;
    public int $puntos;
    public string $ciudad;
    public int $multas;
    public string $estado;
    public string $creado;
    public string $modificado;
    public static $tabla = "conductores";

    // ---- CONSTRUCTOR ----
    public function __construct(int $id, string $nombre, int $puntos, string $ciudad, int $multas, string $estado, string $creado, string $modificado)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->puntos = $puntos;
        $this->ciudad = $ciudad;
        $this->estado = $estado;
        $this->multas = $multas;
        $this->creado = $creado;
        $this->modificado = $modificado;
    }

    // ---- GETTERS ----
    public function getId(): int
    {
        return $this->id;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getPuntos(): int
    {
        return $this->puntos;
    }
    public function getCiudad(): string {
        return $this->ciudad;
    }
    public function getEstado(): string
    {
        return $this->estado;
    }
    public function getMultas(): int
    {
        return $this->multas;
    }
    public function getCreado(): string
    {
        return $this->creado;
    }
    public function getModificado(): string
    {
        return $this->modificado;
    }

    // ---- SETTERS ----
    public function setId(int $miId)
    {
        $this->id = $miId;
    }
    public function setNombre(string $miNombre)
    {
        $this->nombre = $miNombre;
        return $this;
    }
    public function setPuntos(int $misPuntos)
    {
        $this->puntos = $misPuntos;
        return $this;
    }
    public function setCiudad(string $miCiudad) {
        $this->ciudad = $miCiudad;
        return $this;
    }
    public function setEstado(string $miEstado)
    {
        $this->estado = $miEstado;
        return $this;
    }
    public function setMultas(int $misMultas)
    {
        $this->multas = $misMultas;
        return $this;
    }
    public function setFechaCreacion(string $miFechaCreacion)
    {
        $this->creado = $miFechaCreacion;
        return $this;
    }
    public function setFechaModificacion(string $miFechaModificacion)
    {
        $this->modificado = $miFechaModificacion;
        return $this;
    }

    // ---- FUNCIONES ----
    //obtener todos los coches de la base de datos
    public static function getAll()
    {
        $conductores = [];
        $pdo = new Conexion();
        $t = self::$tabla;
        try {
            $db = $pdo->connect();
            $sql_query = "SELECT * FROM {$t}";
            $resultado = $db->query($sql_query);

            // Usamos FETCH_ASSOC para mapear por nombre de columna
            while ($c = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $conductor = new Conductor(
                    $c['id'],
                    $c['nombre'],
                    $c['puntos'],
                    $c['ciudad'],
                    (int)$c['multas'],
                    $c['estado'],
                    $c['creado'],
                    $c['modificado']
                );
                array_push($conductores, $conductor);
            }
        } catch (PDOException $e) {
            die("Ha sucedido un error en la base de datos: " . $e->getMessage());
        }
        return $conductores;
    }

    // conseguir un conductor por su ID
    public static function getConductor(int $id)
    {
        $conductor = null;
        $pdo = new Conexion();
        $t = self::$tabla;
        try {
            $db = $pdo->connect();
            $sql_query = "SELECT * FROM {$t} WHERE id = $id";
            $resultado = $db->query($sql_query);

            if ($c = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $conductor = new Conductor(
                    $c['id'],
                    $c['nombre'],
                    $c['puntos'],
                    $c['ciudad'],
                    (int)$c['multas'],
                    $c['estado'],
                    $c['creado'],
                    $c['modificado']
                );
            }
        } catch (PDOException $e) {
            die("Ha sucedido un error en la base de datos: " . $e->getMessage());
        }
        return $conductor;
    }

    // borrar un conductor por su ID
    public static function borrarConductor(int $id)
    {
        $pdo = new Conexion();
        $t = self::$tabla;
        try {
            $db = $pdo->connect();
            //preparo el delete
            $sql_delete = "DELETE FROM {$t} WHERE id=:id";
            $stmt = $db->prepare($sql_delete);
            //ejecuto el delete
            $stmt->execute([
                ':id' => $id
            ]);
            //informamos en caso de delete exitoso
            if ($stmt->rowCount() > 0) {
                echo "se eliminó un conductor de la base de datos";
            }
        } catch (PDOException $e) {
            //en caso de error informamos y matamos el proceso
            die("Ha sucedido un error en la base de datos: " . $e->getMessage());
        }
    }

    // insertar nuevo conductor
    public function insertarConductor()
    {
        $pdo = new Conexion();
        $t = self::$tabla;
        try {
            $db = $pdo->connect();
            //hacer el insert
            $sql_insert = "INSERT INTO {$t} (nombre, puntos, ciudad, multas, estado, creado, modificado) VALUES (:nombre, :puntos, :ciudad, :multas, :estado, NOW(), NOW())";
            $stmt = $db->prepare($sql_insert);
            $stmt->execute([
                ':nombre'       => $this->nombre,
                ':puntos'       => $this->puntos,
                ':ciudad'       => $this->ciudad,
                ':multas'       => $this->multas,
                ':estado'       => $this->estado,
            ]);

            $this->id = $db->lastInsertId();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            die("Ha sucedido un error en la base de datos: " . $e->getMessage());
        }
    }

    // actualizar conductor
    public function actualizarConductor(int $id)
    {
        $pdo = new Conexion();
        $t = self::$tabla;
        try {
            $db = $pdo->connect();
            //hacer el update
            $sql_update = "UPDATE {$t} SET nombre = :nombre, puntos = :puntos, ciudad = :ciudad,
                                            multas = :multas, estado = :estado, modificado = NOW() WHERE id = :id";
            $stmt = $db->prepare($sql_update);
            $stmt->execute([
                ':nombre' => $this->nombre,
                ':puntos' => $this->puntos,
                ':ciudad' => $this->ciudad,
                ':multas' => $this->multas,
                ':estado' => $this->estado,
                ':id'     => $id
            ]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            die("Ha sucedido un error en la base de datos: " . $e->getMessage());
        }
    }
}
