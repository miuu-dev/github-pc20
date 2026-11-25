<?php
    class CalculadoraImpuestos {
        // PROPIEDAD ESTÁTICA: tasa de impuesto de la clase
        /*
            static -> pertenece solo a esta clase y no se pasan al objeto al instaciar
        */
        public static $TASA_IGV = 0.18;

        // MÉTODO ABSTRACTO: Calcula el precio total con impuestos
        /*
            self:: -> solo se usa en métodos estáticos dentro de la propia clase
            static funcion -> no necesita guardar datos de ningún objeto, por lo que podemos usarlo directamente con ::(nombre de la función) a la hora de usar la clase
        */
        public static function calcularPrecioFinal(float $precioBase) {
            $impuesto = $precioBase * self::$TASA_IGV;
            return $precioBase + $impuesto;
        }

        // MÉTODO ESTÁTICO: Validación simple
        public static function esPrecioValido(float $precio) {
            return is_numeric($precio) && $precio > 0;
        }

        /* 
            EXTRA: parent:: -> se usa en las clases hijas a propiedades y métodos estáticos definidos en la clase padre
        */
    }

    // Uso de utilidades estáticas
    echo "Tasa IGV: " . (CalculadoraImpuestos::$TASA_IGV * 100) . "%<br>";

    $precioProducto = 250.00;
    if (CalculadoraImpuestos::esPrecioValido($precioProducto)) {
        $precioFinal = CalculadoraImpuestos::calcularPrecioFinal($precioProducto);
        echo "Precio final: " . number_format($precioFinal, 2) . "<br>";
    }

?>