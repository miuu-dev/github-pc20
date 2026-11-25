<?php
    class PackLibro extends Producto implements Enviable, Descargable {
        use Descontable;

        // creamos sus propios atributos
        protected float $pesoKg;
        protected float $tamanoMb;

        // constructor
        public function __construct(string $codigo, string $nombre, float $precioBase, float $pesoKg, float $tamanoMb) {
            // tomamos los datos del padre
            parent::__construct($codigo, $nombre, $precioBase);
            $this->pesoKg = $pesoKg;
            $this->tamanoMb = $tamanoMb;
        }

        // obtenemos su tipo
        public function getTipo(): string {
            return "Pack papel + digital";
        }

        // obtenemos su iva
        protected function getIva(): float {
            return 4.0;
        }

        // obtenemos su peso
        public function getPesoKg(): float {
            return $this->pesoKg;
        }

        // calculamos los gastos de envío
        public function calcularGastosEnvio(): float {
            return 2.50 + (1.00 * $this->pesoKg);
        }

        // obtenemos su URL de descarga
        public function getUrlDescarga(): string {
            return "descargas/" . strtolower($this->getCodigo()) . ".pdf";
        }

        // obtenemos su tamaño en MB
        public function getTamanoMb(): float {
            return $this->tamanoMb;
        }
    }