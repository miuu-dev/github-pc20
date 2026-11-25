<?php

    class Camiseta extends Producto implements Enviable {
        public function __construct(
            string $codigo,
            string $nombre,
            float $precioBase,
            protected string $talla, 
            protected float $pesoKg
        ) {
            parent::__construct($codigo, $nombre, $precioBase);
        }

        // creamos los setters con Fluent Interface
        public function setTalla(string $talla) {
            $this->talla = $talla;
            return $this;
        }

        public function setPesoKg(float $pesoKg) {
            $this->pesoKg = $pesoKg;
            return $this;
        }


        // ahora los getters
        // obtenemos su tipo
        public function getTipo(): string {
            return "Camiseta";
        }

        // obtenemos su iva
        protected function getIva(): float {
            return 21.0;
        }

        // obtenemos su peso
        public function getPesoKg(): float {
            return $this->pesoKg;
        }

        // realizamos el envío como libro
        public function calcularGastosEnvio(): float {
            return 1.95;
        }
    }

?>