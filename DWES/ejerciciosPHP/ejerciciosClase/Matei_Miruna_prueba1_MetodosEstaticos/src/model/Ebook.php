<?php

    class Ebook extends Producto implements Descargable {
        use Descontable;

        // creamos sus propios atributos ya en el constructor
        public function __construct(
            string $codigo,
            string $nombre,
            float $precioBase,
            protected string $formato,
            protected float $tamanoMb
        ) {
            parent::__construct($codigo, $nombre, $precioBase);
        }

        // creamos sus setters con Fluente Interface
        public function setFormato(string $formato) {
            $this->formato = $formato;
            return $this;
        }

        public function setTamanoMb(float $tamanoMb) {
            $this->tamanoMb = $tamanoMb;
            return $this;
        }


        // ahora obtenemos sus getters
        public function getTipo(): string {
            return "Ebook";
        }

        protected function getIva(): float {
            return 4.0;
        }


        // obtenemos su url
        public function getUrlDescarga(): string {
            return "descargas/" . strtolower($this->getCodigo()) . "." . $this->formato;
        }

        public function getTamanoMb(): float {
            return $this->tamanoMb;
        }

    }

?>