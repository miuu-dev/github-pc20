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



//Insert
/*
    creamos una variable llamada registros donde indicaremos que desde la variable db queremos que realice la acción 'exec' y en el () ponemos lo que queremos hacer, que es insertar en la tabla personas x valores

    en caso de que la acción haya cumplido con su función, pediremos que nos muestre en la página el número de registros creados
*/
$registros = $db->exec('INSERT INTO personas (nombre) VALUES ("José"),("Luís")');
if ($registros){
    echo "Se han activado $registros registros.";
}
echo "
";


?>