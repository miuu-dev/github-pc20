<?php

    trait FormateaPrecio {
        // crearemos una función donde vamos a pedir que nos den el importe del producto, pero vamos a devolver un string
        public function formateaPrecio(float $importe): string {
            return number_format($importe,2,".","");
        }
    }

?>