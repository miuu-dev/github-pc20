<?php

/**
 * Configuración de la Base de Datos
 * Este archivo contiene los parámetros de conexión a la base de datos
 */

class Database
{
    private $host = "localhost";
    private $db_name = "tareas_db";
    private $username = "root";
    private $password = "";
    private $charset = 'utf8mb4';
    private $conn = null;

    /**
     * Obtiene la conexión a la base de datos
     * @return PDO|null Objeto de conexión o null si falla
     */
    public function getConnection()
    {
        if ($this->conn === null) {
            try {
                $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . "charset=" . $this->charset;

                $this->conn = new PDO($dsn, $this->username, $this->password);

                // configurar PDO para lanzar excepciones en caso de error
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // configurar PDO para devolver arrays asociativos
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Error de conexión " . $e->getMessage());
                return null;
            }
        }

        return $this->conn;
    }
}

/**
 * Envía una respuesta json con el código HTTP correspondiendo
 * @param int $codigo Código HTTP de respuesta
 * @param array $datos Datos a enviar en formato JSON
 */
function respuesta($codigo, $datos)
{
    http_response_code($codigo);
    echo json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}


// conectar bbdd
$newDB = new Database();
$db = $newDB->getConnection();

// verificar conexión
if ($db === null) {
    http_response_code(500);
    echo json_encode([
        'succes' => false,
        'message' => 'Error de conexión a la base de datos'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Acceso a la bbdd para traer todas las colmenos FROM " . $this->table_name . " c
$query = "SELECT 
    t.id, 
    t.titulo, 
    t.descripcion, 
    t.fase, 
    t.estado, 
    t.prioridad, 
    u.usuario_id, 
    t.fecha_creacion as 'fecha_creacion', 
    t.fecha_actualizacion as 'fecha_actualizacion ' 
    FROM " . "tareas" . " t LEFT JOIN usuarios u ON t.usuario_id = u.id ORDER BY t.id DESC";

$stmt = $db->prepare($query);
$stmt->execute();

// recorridad del recodSet devuelto por la consulta
$num = $stmt->rowCount();

if ($num > 0) {
    $arrayTareas = [];

    while ($row = $stmt->fetch()) {
        $tareas_item = [
            'id' => (int) $row['id'],
            'titulo' => $row['titulo'],
            'descripcion' => $row['descripcion'],
            'fase' => $row['fase'],
            'estado' => $row['estado'],
            'prioridad' => $row['prioridad'],
            'fecha_creacion' => $row['fecha_creacion'],
            'fecha_actualizacion' => $row['fecha_actualizacion'],
            'usuario_id' => (int) $row['usuario_id'],
        ];
        array_push($arrayTareas, $tareas_item);
    }
    respuesta(200, [
        'success' => true,
        'total' => 0,
        'data' => [],
        'message' => 'No se encontraros  tareas'
    ]);
} else {
    respuesta(200, [
        'success' => true,
        'total' => 0,
        'data' => [],
        'message' => 'No se encontraron colmenas'
    ]);
}
