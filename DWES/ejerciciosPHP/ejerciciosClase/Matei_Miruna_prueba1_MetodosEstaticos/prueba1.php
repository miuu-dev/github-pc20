<?php

    // incluimos las interfaces
    require_once "src/interface/Enviable.php";
    require_once "src/interface/Descargable.php";

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

    // ----------------------------------------------------
    // creamos un objeto de cada tipo
    $libro1 = new Libro(
        codigo: "LIB01",
        nombre: "Aprende PHP desde cero",
        precioBase: 24.00,
        autor: "Laura Gomez",
        pesoKg: 0.8
    );

    $ebook1 = new Ebook(
        codigo:"EBK01",
        nombre: "Git para principiantes",
        precioBase: 9.99,
        formato: "EPUB",
        tamanoMb: 3.2
    );

    $camiseta1 = new Camiseta(
        codigo:"CAM01",
        nombre: "Camiseta \"Hola Mundo\"",
        precioBase: 15.00,
        talla: "M",
        pesoKg: 0.2
    );

    $packLibro1 = new PackLibro(
        codigo: "PC1",
        nombre:"Base de datos con MySQL",
        precioBase: 32.00,
        pesoKg: 1.1,
        tamanoMb: 8.4
    );

    // aplicamos un descuento del 10%  a los productos con trait descontable
    $libro1->aplicarDescuento(10);
    $ebook1->aplicarDescuento(10);
    // $camiseta->aplicarDescuento(10); -> daría error porque no tiene el trait Descontable
    $packLibro1->aplicarDescuento(10);

    // -------------------------------------------------

    // guardamos los objetos en un array
    $productos = [$libro1, $ebook1, $camiseta1, $packLibro1];

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

?>