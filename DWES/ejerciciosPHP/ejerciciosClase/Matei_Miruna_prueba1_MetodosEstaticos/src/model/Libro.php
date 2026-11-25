<?php

    class Libro extends Producto implements Enviable {
        use Descontable;

        // creamos sus propios atributos ya en el constructor
        public function __construct(
            string $codigo,
            string $nombre,
            float $precioBase,
            protected string $autor,
            protected float $pesoKg
        ) {
            parent::__construct($codigo, $nombre, $precioBase);
        }

        // creamos los métodos set con Fluent Interface
        public function setAutor(string $autor) {
            $this->autor = $autor;
            return $this;
        }

        public function setPesoKg(float $pesoKg) {
            $this->pesoKg = $pesoKg;
            return $this;
        }

        // ahora obtenemos los getters
        public function getTipo(): string {
            return "Libro";
        }
        protected function getIva(): float {
            return 4.0;
        }
        public function getPesoKg(): float {
            return $this->pesoKg;
        }
        public function calcularGastosEnvio(): float {
            return 2.50 + (1.00 * $this->pesoKg);
        }

    }

?>