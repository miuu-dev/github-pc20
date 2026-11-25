<?php

    // incluimos las interfaces
    require_once "src/interfaces/Enviable.php";
    require_once "src/interfaces/Descargable.php";

    // inlcuimos los traits
    require_once "src/traits/Descontable.php";
    require_once "src/traits/FormateaPrecio.php";

    // inlcuimos el modelo padre
    require_once "src/model/Producto.php";

    // incluimos los modelos hijos
    require_once "src/model/Libro.php";
    require_once "src/model/Ebook.php";
    require_once "src/model/Camiseta.php";
    require_once "src/model/PackLibro.php";


    // -------------------------------------------------
    
    // creamos un objeto de cada tipo
    $libro = new Libro("LIB01", "Aprende PHP desde cero", 24.00, "Laura Gomez", 0.8);
    $ebook = new Ebook("EBK01", "Git para principiantes", 9.99, "EPUB", 3.2);
    $camiseta = new Camiseta("CAM01", "Camiseta \"Hola Mundo\"", 15.00, "M", 0.2);
    $pack = new PackLibro("PCK01", "Bases de datos con MySQ", 32.00, 1.1, 8.4);
    // $p = new Producto('X', 'Prueba', 10);

    // aplicamos un descuento del 10%  a los productos con trait descontable
    $libro->aplicarDescuento(10);
    $ebook->aplicarDescuento(10);
    // $camiseta->aplicarDescuento(10); -> daría error porque no tiene el trait Descontable
    $pack->aplicarDescuento(10);

    // -------------------------------------------------

    // guardamos los objetos en un array
    $productos = [$libro, $ebook, $camiseta, $pack];

    // recorremos el array con un foreach y mopstramos la información de cada producto
    foreach ($productos as $p) {
        echo "<h3>" . $p->getTipo() . ": " . $p->getNombre() . "</h3>";
        echo "Precio base: " . $p->getPrecioBase() . "€<br>";
        echo "Descuento: " . $p->getDescuento() . "%<br>";
        echo "Precio final (con IVA): " . $p->getPrecioFinal() . "€<br>";

        // si es enviable hacemos un instanceof mostrando peso y gastos de envío
        if ($p instanceof Enviable) {
            echo "Es ENVIABLE → " . $p->getPesoKg() . "kg, gastos de envío: " . $p->calcularGastosEnvio() . "€<br>";
        }

        // si es descargable hacemos un instanceof mostrando el formato y el tamaño
        if ($p instanceof Descargable) {
            echo "URL: " . $p->getUrlDescarga() . "<br>";
            echo "Tamaño: " . $p->getTamanoMb() . "MB<br>";
        }
    }

    /* PREGUNTAS
        1. añade la línea $p = new Producto('X', 'Prueba', 10);. ¿Qué error aparece? ¿Por qué tiene sentido?
            Me daría el siguiente error (traducido al español): Error fatal: Error no detectado: No se puede crear una instancia de la clase abstracta Producto en/var/www/html/Matei_Miruna_prueba1/prueba1.php:28 Rastro de pila: #0 {main} arrojado en/var/www/html/Matei_Miruna_prueba1/prueba1.php en la línea 28.

            La razón por la que aparece es porque la clase Producto es abstracta que representa un concepto genérico causando que no se pueda instanciar directamente ya que le faltan definiciones obligatorias como los métodos getTipo() y getIva().
        
        2. Quita el comentario de $camiseta->aplicarDescuento(10);. ¿Qué error aparece? ¿Qué tendrías que cambiar en Camiseta para que funcionara? 
            Me daría el siguiente error (traducido al español): Error fatal: Error no detectado: Llamada al método indefinido Camiseta::aplicarDescuento() en/var/www/html/Matei_Miruna_prueba1/prueba1.php:33 Rastreo de pila: #0 {main} arrojado en/var/www/html/Matei_Miruna_prueba1/prueba1.php en la línea 33

            La razón por la que aparece es porque estamos indicandole a camiseta que aplique el método aplicarDescuento() cuando la clase camiseta no tiene el trait Descontable que contiene la definición de ese método. Para que funcionara tendríamos que añadir el trait Descontable a la clase Camiseta.

        3. ¿Por qué el pack aparece a la vez como enviable y como descargable? ¿Se podría conseguir solo con herencia? 
            Aparece así porque implementa ambas interfaces y no se podría conseguir con herencia simple porque PHP no permite la herencia múltiple de clases.

        4. ¿Por qué la camiseta muestra "Descuento: 0 %" si nunca le has aplicado un descuento ni tiene el trait? 
            Porque la clase Producto tiene un atributo descuento que se inicializa a 0 y la clase Camiseta hereda de Producto, por lo que al no aplicarle ningún descuento, el valor del atributo descuento sigue siendo 0.
    */
