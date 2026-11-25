<?php 

    class Libro extends Producto implements Enviable {
        // usamos el trait Descontable
        use Descontable;

        // creamos ahora los atributos propios
        protected string $autor;
        protected float $pesoKg;

        // SIEMPRE SE HACE EL CONSTRUCTOR
        public function __construct(string $codigo, string $nombre, float $precioBase, string $autor, float $pesoKg) {
            // queremos que esta función adopte la construcción del padre (Producto)
            parent::__construct($codigo, $nombre, $precioBase);
            // ahora indicamos quien es el autor y cual es su peso en kg
            $this->autor = $autor;
            $this->pesoKg = $pesoKg;
        }

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