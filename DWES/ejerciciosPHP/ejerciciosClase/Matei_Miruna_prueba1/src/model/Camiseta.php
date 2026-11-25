<?php

    class Camiseta extends Producto implements Enviable {
        // no nos pide ningún trait, así que no metemos ninguno 
        
        // creamos sus propios atributos
        protected string $talla;
        protected float $pesoKg;

        // ahora creamos su constructor
        public function __construct(string $codigo, string $nombre, float $precioBase, string $talla, float $pesoKg) {
            // tomamos los datos del padre
            parent::__construct($codigo, $nombre, $precioBase);
            $this->talla = $talla;
            $this->pesoKg = $pesoKg;
        }

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