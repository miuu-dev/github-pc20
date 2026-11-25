<?php 

//Conexión con control de errores
/*
    intentaremos conectarnos a la base de datos prueba, diciendo que nos queremos conectar con root y sin contraseña. además de que también puede indicarnos los errores posibles

    en caso de que falle, queremos que nos muestre por pantalla que la conexión falló y nos muestre su mensaje de el por qué ha fallado
*/
$opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
try {
    $db = new PDO('mysql:host=localhost;dbname=prueba', 'root', '', $opciones);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}



//Update
/*
    Estamos indicando que de la tabla personas queremos poner la columna 'activo', todos sus datos a 1, pero que sean aquellos que tengan un 0
*/
$registros = $db->exec('UPDATE personas SET activo=1 WHERE activo=0');
if ($registros){
    echo "Se han activado $registros registros.";
}
echo "
";

?>