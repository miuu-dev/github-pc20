<?php

    class PackLibro extends Producto implements Enviable, Descargable {
        use Descontable;

        public function __construct(
            string $codigo,
            string $nombre,
            float $precioBase,
            protected float $pesoKg,
            protected float $tamanoMb
        ) {
            parent::__construct($codigo, $nombre, $precioBase);
        }

        // ahora aplicamos los setters con Fluent Interface
        public function setPesoKg(float $pesoKg) {
            $this->pesoKg = $pesoKg;
            return $this;
        }

        public function setTamanoMb(float $tamanoMb) {
            $this->tamanoMb = $tamanoMb;
            return $this;
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

?>