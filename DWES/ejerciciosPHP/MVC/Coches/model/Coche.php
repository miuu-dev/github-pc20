<?php
require_once("Conexion.php");
class Coche{
    //Variables o atributos
    public $marca;
    public $modelo;
    public $color;
    public $propietario;
    public $precio;
    public $id;
    public static $tabla="miscoches";

    public function __construct($miMarca, $miModelo, $miColor, $miPropietario, $miPrecio, $miId){
        $this->marca = $miMarca;
        $this->modelo = $miModelo;
        $this->color = $miColor;
        $this->propietario = $miPropietario;
        $this->precio=$miPrecio;
        $this->id=$miId;
    }

    //Funciones o métodos
    public function setMarca($miMarca){
        $this->marca = $miMarca;
    }

    public function getMarca(){
        return $this->marca;
    }

    public function setModelo($miModelo){
        $this->modelo = $miModelo;
    }

    public function getModelo(){
        return $this->modelo;
    }

    public function setColor($miColor){
        $this->color = $miColor;
    }

    public function getColor(){
        return $this->color;
    }

    public function setPropietario($miPropietario){
        $this->propietario = $miPropietario;
    }

    public function getPropietario(){
        return $this->propietario;
    }

    //obtener todos los coches de la base de datos
    public static function getAll(){
        $coches = [];
        $pdo = new Conexion();
        $t = self::$tabla;
        try {
            $db = $pdo->connect();
            $sql_query = "SELECT * FROM {$t}";
            $resultado = $db->query($sql_query);
            
            // Usamos FETCH_ASSOC para mapear por nombre de columna
            while ($c = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $coche = new Coche(
                    $c['marca'], 
                    $c['modelo'], 
                    $c['color'], 
                    $c['propietario'], 
                    (float)$c['precio'], 
                    $c['id']
                );
                array_push($coches, $coche);
            }
        } catch (PDOException $e) {
            die("Ha sucedido un error en la base de datos: " . $e->getMessage());
        }
        return $coches;
    }

    //obtener un coche por id
    public static function getCoche($id){
        $coche = null;
        $pdo = new Conexion();
        $t = self::$tabla;
        try {
            $db = $pdo->connect();
            $sql_query = "SELECT * FROM {$t} WHERE id = $id";
            $resultado = $db->query($sql_query);
            
            if ($c = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $coche = new Coche(
                    $c['marca'], 
                    $c['modelo'], 
                    $c['color'], 
                    $c['propietario'], 
                    (float)$c['precio'], 
                    $c['id']
                );
            }
        } catch (PDOException $e) {
            die("Ha sucedido un error en la base de datos: " . $e->getMessage());
        }
        return $coche;
    }

    //borrar un coche por id
    public static function borrarCoche(int $id){
        $pdo=new Conexion();
        $t=self::$tabla;
        try{
            $db=$pdo->connect();
            //preparo el delete
            $sql_delete="DELETE FROM {$t} WHERE id=:id";
            $stmt=$db->prepare($sql_delete);
            //ejecuto el delete
            $stmt->execute([
                ':id'=>$id
            ]);
            //informamos en caso de delete exitoso
            if ($stmt->rowCount()>0) {
                echo "se elemino un coche de la base de datos";
            }
        }catch (PDOException $e){
            //en caso de error informamos y matamos el proceso
            die("ha sucedido un error en la base de datos".$e->getMessage());
        }
    }

    //insertar un nuevo coche en la base de datos
    public function insertarCoche(){
        $pdo=new Conexion();
        $t=self::$tabla;
        try{
            $db=$pdo->connect();
            //hacer el insert
            $sql_insert= "INSERT INTO {$t} (marca, modelo, color, propietario, precio) VALUES (:marca, :modelo, :color, :propietario, :precio)";
            $stmt=$db->prepare($sql_insert);
            $stmt->execute([
                    ':marca'       => $this->marca,
                    ':modelo'      => $this->modelo,
                    ':color'       => $this->color,
                    ':propietario' => $this->propietario,
                    ':precio'      => $this->precio
                ]);

            $this->id = $db->lastInsertId();
            return $stmt->rowCount() > 0;
        }catch(PDOException $e){
            die("Ha sucedido un error en la base de datos: " . $e->getMessage());
        }
    }

    // actualizar un coche por ID
    public function actualizarCoche() {
        $pdo = new Conexion();
        $t = self::$tabla;
        try {
            $db = $pdo->connect();
            // Preparo el update indicando las columnas a modificar y el id de condición
            $sql_update = "UPDATE {$t} SET marca = :marca, modelo = :modelo, color = :color, propietario = :propietario, precio = :precio WHERE id = :id";
            $stmt = $db->prepare($sql_update);
            
            // Ejecuto la sentencia pasando los valores del objeto actual
            $stmt->execute([
                ':marca'       => $this->marca,
                ':modelo'      => $this->modelo,
                ':color'       => $this->color,
                ':propietario' => $this->propietario,
                ':precio'      => $this->precio,
                ':id'          => $this->id
            ]);

            return $stmt->rowCount() > 0;

        } catch (PDOException $e) {
            // En caso de error informamos y matamos el proceso (añadido el punto y coma que faltaba)
            die("No se ha podido actualizar el coche: " . $e->getMessage());
        }
    }
}