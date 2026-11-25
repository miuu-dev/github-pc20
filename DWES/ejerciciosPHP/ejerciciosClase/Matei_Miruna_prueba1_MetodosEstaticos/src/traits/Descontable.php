<?php

    trait Descontable {
        // creamos una variable que solo usaremos en este trait y ponemos 0.0 porque queremos guardar los datos que obtengamos conforme lo usemos
        private float $descuento = 0.0;

        // creamos una función que sirva para aplicar el descuento, pero le direremos que $descuento equivale al resultado obtenido después de realizar el cálculo y para ello pondremos void para que no tengamos que poner ningún return
        // le ponemos public porque conforme apliquemos este trait, vamos a usar sí o sí la función
        public function aplicarDescuento(float $porcentaje): void {
            if ($porcentaje < 0 || $porcentaje > 50) {
                throw new InvalidArgumentException("El descuento debe estar entre 0 y 50, sin usar decimales");
                $this->descuento = $porcentaje;
            }
        }

        // ahora crearemos una función donde obtendremos el descuento
        public function getDescuento(): float {
            return $this->descuento;
        }
    }

?>