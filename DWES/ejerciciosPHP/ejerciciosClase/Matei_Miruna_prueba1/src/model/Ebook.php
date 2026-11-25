<?php

    class Ebook extends Producto implements Descargable {
        // usamos el trait Descontable
        use Descontable;

        // creamos sus propios atributos
        protected string $formato;
        protected float $tamanoMb;

        // creamos su constructor
        public function __construct(string $codigo, string $nombre, float $precioBase, string $formato, float $tamanoMb) {
            // queremos que esta función adopte la construcción del padre (Producto)
            parent::__construct($codigo, $nombre, $precioBase);
            $this->formato = $formato;
            $this->tamanoMb = $tamanoMb;
        }

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